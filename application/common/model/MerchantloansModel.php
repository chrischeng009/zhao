<?php
namespace app\common\model;

use think\Model;
use think\Db;

class MerchantloansModel extends Model{
    public static function tbname(){
        return db('merchantloans');
    }
    //添加一条记录
    public static function add($data){
        return self::tbname()->insertGetId($data);
    }
    //查询一条记录
    public static function find($where=''){
        return self::tbname()->where("1=1 $where")->order('id desc')->find();
    }
    //查询多条记录
    public static function select($where=''){
        return self::tbname()->where("1=1 $where")->order('id desc')->select();
    }
    //删除一条记录或多条记录
    public static function del($where){
        return self::tbname()->where("1=1 $where")->delete();
    }
    //修改一条记录
    public static function edit($where,$data){
        return self::tbname()->where("1=1 $where")->update($data);
    }
    //统计表的记录条数
    public static function count($where=''){
        return self::tbname()->where("1=1 $where")->count();
    }
    //求和
    public static function sum($where='',$field){
        return self::tbname()->where("1=1 $where")->sum($field);
    }
    // 求出当日的业务员旗下的商家当日贷款金额
    public static function summoney($aid,$starttime,$lasttime,$mobile){
        $sumarr="" ;
        $day = date("Y-m-d");
        $start_time = !empty($starttime)? strtotime($starttime . " 00:00:00"):strtotime($day . " 00:00:00");
        $last_time = !empty($lasttime)?strtotime($lasttime . " 23:59:59"):strtotime($day." 23:59:59");
        $sumarr .=" and a.uptime>={$start_time} and a.uptime<={$last_time}";
        $sumarr .=" and a.status = 2";
        if($aid){
            $sumarr .=" and b.aid ={$aid}";
        }
        if($mobile){
            $sumarr .=" and b.mobile ={$mobile}";
        }
        // 关联商家表进行查询
        $join = [
            ['merchant b','b.id=a.merchant_id'],
        ];
        $sum=self::tbname()->alias('a')->join($join)->field('a.*,b.aid,b.mobile')->where("1=1 $sumarr")->sum('a.money');
        return $sum;
    }
    public static function enum_status_arr()
    {
        $arr[1] = '待审核';
        $arr[2] = '已通过';
        $arr[3] = '已拒绝';
        return $arr;
    }
    public static function enum_status_text($key)
    {
        $arr = self::enum_status_arr();
        if(!isset($arr[$key])){
            return '';
        }
        return $arr[$key];
    }
    /*
     * 处理贷款
     */
    public static function do_edit($id,$data)
    {
        Db::startTrans();
        try{
            ////数据处理
            $find = self::find("and id=".$id);
            if($find['status']!=1){
                return "请勿重处理";
            }
            
            $find_merchant = MerchantModel::find("and id=".$find['merchant_id']);
            $data['uptime'] = time();
            self::edit("and id='".$id."'",$data);
            
            //已通过
            if($data['status']==2){
                $mdata = [];
                $mdata['money'] = $find_merchant['money']+$find['money'];
                $mdata['loans_money'] = $find_merchant['loans_money']+$find['money'];
                MerchantModel::edit("and id={$find['merchant_id']}",$mdata);
                //查询商家店铺
                $find_shop = ShopModel::find("and merchant_id={$find['merchant_id']}");
                //记录商家财务明细
                $ldata = [];
                $ldata['algorithm'] = 1;//加法
                $ldata['type'] = 3;//贷款
                $ldata['merchant_id'] = $find['merchant_id'];//商家Id
                $ldata['shop_id'] = isset($find_shop['id'])?$find_shop['id']:"";//店铺Id
                $ldata['startmoney'] = $find_merchant['money'];//操作前余额
                $ldata['money'] = $find['money'];//变动金额
                $ldata['endmoney'] = $find_merchant['money']+$find['money'];//操作后金额
                $ldata['order_code'] = "";//订单号
                $ldata['tradeno'] = "";//流水号
                $ldata['remark'] = "贷款金额由{$find_merchant['loans_money']}元升到{$mdata['loans_money']}元";//详情
                $ldata['intime'] = time();
                $ldata['uptime'] = time();
                MerchantmlogsModel::add($ldata);
            }
            
            //提交
            Db::commit();
            //返回
            return 'success';
        }catch(\Exception $e){
            Db::rollback();
            //exception($e);//直接报调试模式错误信息
            //$this->error($e->getMessage());//把异常消息捕获并抛出
            return '操作失败';
        }
    }
    /*
     * 处理还款
     */
    public static function do_refund($params)
    {
        Db::startTrans();
        try{
            $find_merchant = MerchantModel::find("and id=".$params['merchant_id']);
            
            //判断还款金额
            if($find_merchant['loans_money']<=0){
                return "您无需还款";
            }
            if($params['money']>$find_merchant['money']){
                return "余额不足";
            }
            if($params['money']>$find_merchant['loans_money']){
                return "还款金额已超贷款金额";
            }
            
            $mdata = [];
            $mdata['money'] = $find_merchant['money']-$params['money'];
            $mdata['loans_money'] = $find_merchant['loans_money']-$params['money'];
            MerchantModel::edit("and id={$params['merchant_id']}",$mdata);
            //查询商家店铺
            $find_shop = ShopModel::find("and merchant_id={$params['merchant_id']}");
            //记录商家财务明细
            $ldata = [];
            $ldata['algorithm'] = 2;//减法
            $ldata['type'] = 4;//还款
            $ldata['merchant_id'] = $params['merchant_id'];//商家Id
            $ldata['shop_id'] = isset($find_shop['id'])?$find_shop['id']:"";//店铺Id
            $ldata['startmoney'] = $find_merchant['money'];//操作前余额
            $ldata['money'] = $params['money'];//变动金额
            $ldata['endmoney'] = $find_merchant['money']-$params['money'];//操作后金额
            $ldata['order_code'] = "";//订单号
            $ldata['tradeno'] = "";//流水号
            $ldata['remark'] = "贷款金额由{$find_merchant['loans_money']}元降到{$mdata['loans_money']}元";//详情
            $ldata['intime'] = time();
            $ldata['uptime'] = time();
            MerchantmlogsModel::add($ldata);
            
            //提交
            Db::commit();
            //返回
            return 'success';
        }catch(\Exception $e){
            Db::rollback();
            //exception($e);//直接报调试模式错误信息
            //$this->error($e->getMessage());//把异常消息捕获并抛出
            return '操作失败';
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>