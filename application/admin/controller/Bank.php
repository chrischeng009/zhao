<?php
namespace app\admin\controller;

use think\Controller;
use app\common\model\BankModel;//本model放最后方便看清是否弄错

class Bank extends Controller
{
    public function lists()
    {
        $this->isAuth();
        $where = '';
        $_GET['name'] = gett('name');
        if(!empty($_GET['name'])){
            $where .= " and name like '%".$_GET['name']."%'";
        }
        
        $limit = !empty($_GET['limit'])?$_GET['limit']:10;
        $page = !empty($_GET['page'])?$_GET['page']:1;
        $params = ['page'=>$page,'query'=>['name'=>$_GET['name']]];
        $query = BankModel::tbname()->where("1=1 $where")->order('sort asc,id desc')->paginate($limit,false,$params);
        $page_show = $query->render();
        $this->assign('page_show',$page_show);
        $this->assign('lists',$query);

    	return $this->fetch();
    }
    public function add()
    {
        $this->isAuth();
    	return $this->fetch();
    }
    public function act_add()
    {
        $this->isAuth();
        $data = $_POST;
        $data['intime'] = time();
        $data['uptime'] = time();
        $result = BankModel::add($data);
        if($result){
            echo 'success';
        }else{
            echo '操作失败';
        }
    }
    public function act_del()
    {
        $this->isAuth();
        $result = BankModel::del("and id='".postt('id')."'");
        if($result){
            echo 'success';
        }else{
            echo '操作失败';
        }
    }
    public function edit()
    {
        $this->isAuth();
        $find = BankModel::find("and id=".gett('id'));
        $this->assign('find',$find);
        
        return $this->fetch();
    }
    public function act_edit()
    {
        $this->isAuth();
        $data = $_POST;
        unset($data['id']);
        $data['uptime'] = time();
        $result = BankModel::edit("and id='".postt('id')."'",$data);
        if($result){
            echo 'success';
        }else{
            echo '操作失败';
        }
    }









    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
