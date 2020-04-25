<?php
namespace app\common\model;

use think\Model;
use think\Db;

class MenuModel extends Model{
    public static function tbname(){
        return db('menu');
    }
    //添加一条记录
    public static function add($data){
        return self::tbname()->insertGetId($data);
    }
    //查询一条记录
    public static function find($where=''){
        return self::tbname()->where("1=1 $where")->find();
    }
    //查询多条记录
    public static function select($where=''){
        return self::tbname()->where("1=1 $where")->order('sort asc,name asc')->select();
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
    public static function enum_isshow_arr()
    {
        $arr[1] = '是';
        $arr[2] = '否';
        return $arr;
    }
    public static function enum_isshow_text($key)
    {
        $arr = self::enum_isshow_arr();
        if(!isset($arr[$key])){
            return '';
        }
        return $arr[$key];
    }
    
   
    
    
    
    
}
?>