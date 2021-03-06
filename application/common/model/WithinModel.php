<?php
namespace app\common\model;

use think\Model;
use think\Db;

class WithinModel extends Model{
    public static function tbname(){
        return db('within');
    }
    //添加一条记录
    public static function add($data){
        return self::tbname()->insertGetId($data);
    }
    //查询一条记录
    public static function find($where=''){
        return self::tbname()->where("1=1 $where")->order('price desc')->find();
    }
    //查询多条记录
    public static function select($where=''){
        return self::tbname()->where("1=1 $where")->order('price asc')->select();
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
    /*
     * 取佣金费
     */
    public static function get_price($price)
    {
        $find = self::find("and start<={$price}");
        $money = isset($find['price'])?$find['price']:0;
        return $money;
    }
    /*
     * 最大订单截止价
     */
    public static function get_maxend()
    {
        $find = self::tbname()->where("1=1")->order('end desc')->find();
        return $find['end'];
    }
    
    
}
?>