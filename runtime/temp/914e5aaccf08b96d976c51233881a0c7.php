<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:40:"./application/admin/view/admin/edit.html";i:1586928886;s:61:"/www/wwwroot/nouser/application/admin/view/common/header.html";i:1586928883;s:59:"/www/wwwroot/nouser/application/admin/view/common/menu.html";i:1586928883;s:61:"/www/wwwroot/nouser/application/admin/view/common/footer.html";i:1586928883;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo atitle();?></title>
<link href="/css/root.css" rel="stylesheet">
</head>
<body>
<div class="loading"><img src="/img/loading.gif" alt="loading-img"></div>
<div id="top" class="clearfix" style="background:<?php echo $_SESSION['acolor']; ?>;">
    <div class="applogo">
        <a href="/home.php/admin/admin/index.html" class="logo">管控台</a>
    </div>
    <a href="javascript:;" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="javascript:;" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <ul class="topmenu" style="padding-left:20px;">
        <li><a href="/home.php/admin/admin/index.html">首页</a></li>
        <?php if($_SESSION['role_id']==1){?>
        <li><a href="/merchant.php" target="_blank">商家端</a></li>
        <!--<li><a href="/home.php/user/user/index.html" target="_blank">粉丝端</a></li>-->
        <?php }?>
    </ul>
    <ul class="top-right">
        <?php if($_SESSION['role_id']==2){?>
        <li style="float: left">红包使用金额：<?php  echo kefuhongbao($_SESSION['admin_id']);?></li>
        <li style="float: left">余额：<?php  echo kefumoney($_SESSION['admin_id']);?></li>
        <?php }?>
        <li class="dropdown link">
            <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle profilebox">
                <img src="/img/profileimg.png" alt="img"><b style="color:#fff;"><?php echo $_SESSION['admin_name']; ?></b><span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <li><a href="/home.php/admin/admin/edit_password.html"><i class="fa falist fa-lock"></i>修改密码</a></li>
                <li><a href="/home.php/admin/admin/edit_self.html"><i class="fa falist fa-user"></i>修改资料</a></li>
                <li><a href="/home.php/admin/admin/logout.html"><i class="fa falist fa-power-off"></i> 退出</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="sidebar clearfix">
    <ul class="sidebar-panel nav">
        <!--li class="sidetitle">MENU</li-->
        <?php
        use app\common\model\MenuModel;
        use app\common\model\AdminModel;
        use think\Db;
        $module = request()->module();
        $control = strtolower(request()->controller());
        $action = request()->action();
        $find_menu = MenuModel::find("and control='".$control."' and action='".$action."'");
        $menu_name = isset($find_menu['name'])?$find_menu['name']:"菜单未配置";
        $findAdmin = AdminModel::find("and id='".$_SESSION['admin_id']."'");
        $authArr = !empty($findAdmin['auths'])?json_decode($findAdmin['auths'],true):[];
        $where='';
        /*
        <!--$day = date("Y-m-d");-->
        <!--$where .= " and uptime >= '" . strtotime($day . " 00:00:00") . "'";-->
        <!--$where .= " and uptime <= '" . strtotime($day . " 23:59:59") . "'"; -->*/
        //非超级管理员
        if($_SESSION['role_id']==5){
        $tid=$_SESSION['admin_id'];
        $mcarr = Db::table('merchant')->where("aid=".$tid)->select();
        if(empty($mcarr)){
        }else{
        $str = "";
        foreach($mcarr as $v){
        $str .= $v['id'].',';
        }
        $strId =substr($str, 0, -1);
        $where .= " and merchant_id in(".$strId.")";
        }
        }
        if($_SESSION['role_id']==2){
        $where .= " and aid='".$_SESSION['admin_id']."'";
        }

        $tkorder=Db::table('order')->where(" type=2 and status2=1 and exceptioninfo !='申请下架' $where")->count();
        $xjorder=Db::table('order')->where(" type=2 and status2=1 and exceptioninfo ='申请下架' $where")->count();
        $ycorder=Db::table('order')->where(" type=3 and status3=1 and exceptioninfo !='申请下架' $where")->count();
        $comorder=Db::table('order')->where(" type in (1,3) and iscomment=2 $where")->count();

        $menu_lists = MenuModel::select("and pid=0");
        foreach($menu_lists as $v){
        $auth_name = $v['control']."-".$v['action'];
        $findMenu = MenuModel::find("and control='".$control."' and action='".$action."'");
        $active = '';
        $display = '';
        if($v['id']==$findMenu['pid']){ $active='active'; $display='display:block';}
        $child = MenuModel::select("and isshow=1 and pid=".$v['id']);
        if(in_array($auth_name,$authArr) && $v['isshow']==1){
        ?>
        <li>
            <a href="javascript:;" class="<?php echo $active; ?>">
                <span class="icon color7"><i class="fa <?php echo $v['icon']; ?>"></i></span><?php echo $v['name']; ?><span class="caret"></span>
            </a>
            <ul style="<?php echo $display; ?>">
                <?php
                if($child){
                foreach($child as $vv){
                $auth2_name = $vv['control']."-".$vv['action'];
                if(in_array($auth2_name,$authArr)){
                if($vv['control']=='user' && $vv['action']=='lists2'){?>
                <li>
                    <a href="/home.php/admin/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html?status=2"><?php echo $vv['name']; ?></a>
                </li>
                <?php }elseif($vv['control']=='order' && $vv['action']=='lists2'){ ?>
                <li>
                    <a href="/home.php/admin/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html?status2=1"><?php echo $vv['name']; ?><i style="
                    position: absolute;right: 6px;top: 14px;height: 20px;width: 20px;line-height: 20px;background-color: #fc6d26;z-index: 99;
                    text-align: center;
                    border-radius: 6px;
                    cursor: pointer;
                    font-family: arial;
                    font-size: 14px;
                    font-weight: bold;"><?php echo $tkorder; ?></i></a>
                </li>
                <?php }elseif($vv['control']=='order' && $vv['action']=='offlists2'){ ?>
                <li>
                    <a href="/home.php/admin/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html?status2=1"><?php echo $vv['name']; ?><i style="
                    position: absolute;right: 6px;top: 14px;height: 20px;width: 20px;line-height: 20px;background-color: #fc6d26;z-index: 99;
                    text-align: center;
                    border-radius: 6px;
                    cursor: pointer;
                    font-family: arial;
                    font-size: 14px;
                    font-weight: bold;"><?php echo $xjorder; ?></i></a>
                </li>
                <?php }elseif($vv['control']=='order' && $vv['action']=='lists3'){ ?>
                <li>
                    <a href="/home.php/admin/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html?status3=1"><?php echo $vv['name']; ?><i style="
                    position: absolute;right: 6px;top: 14px;height: 20px;width: 20px;line-height: 20px;background-color: #fc6d26;z-index: 99;
                    text-align: center;
                    border-radius: 6px;
                    cursor: pointer;
                    font-family: arial;
                    font-size: 14px;
                    font-weight: bold;"><?php echo $ycorder; ?></i></a>
                </li>
                <?php }elseif($vv['control']=='order' && $vv['action']=='comment'){ ?>
                <li>
                    <a href="/home.php/admin/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html"><?php echo $vv['name']; ?><i style="
                    position: absolute;right: 6px;top: 14px;height: 20px;width: 20px;line-height: 20px;background-color: #fc6d26;z-index: 99;
                    text-align: center;
                    border-radius: 6px;
                    cursor: pointer;
                    font-family: arial;
                    font-size: 14px;
                    font-weight: bold;"><?php echo $comorder; ?></i></a>
                </li>
                <?php }else{ ?>
                <li>
                    <a href="/home.php/admin/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html"><?php echo $vv['name']; ?></a>
                </li>
                <?php } } } }?>
            </ul>
        </li>
        <?php } }?>
    </ul>
</div>


<div class="content">
    <div class="page-header">
        <h1 class="title"><?php echo $menu_name; ?></h1>
    </div>
    <div class="container-padding">
        <div class="row">
            <form action="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit.html" class="form-horizontal" method="post" id="dx_form" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding-top:15px;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">用户名</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="admin_name" value="<?php echo $find['admin_name']; ?>">
                            </div>
                            <label class="col-sm-2 control-label form-label">密码</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="password" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">昵称</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="name" value="<?php echo $find['name']; ?>">
                            </div>
                            <label class="col-sm-2 control-label form-label">角色</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="role_id">
                                    <option value="">请选择</option>
                                    <?php foreach($role_list as $v){?>
                                    <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$find['role_id']){ echo 'selected';}?>><?php echo $v['name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">姓名</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="realname" value="<?php echo $find['realname']; ?>">
                            </div>
                            <label class="col-sm-2 control-label form-label">领取任务</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="iswork">
                                    <option value="">请选择</option>
                                    <?php foreach($enum_iswork_arr as $k=>$v){?>
                                    <option value="<?php echo $k; ?>" <?php if($k==$find['iswork']){ echo 'selected';}?>><?php echo $v; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">手机号</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="mobile" value="<?php echo $find['mobile']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">QQ号</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="qq" value="<?php echo $find['qq']; ?>">
                            </div>
                            <label class="col-sm-2 control-label form-label">微信号</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="weixin" value="<?php echo $find['weixin']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">开户银行</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="bankname">
                                    <option value="">请选择</option>
                                    <?php foreach($bank_list as $k=>$v){?>
                                    <option value="<?php echo $v['name']; ?>" <?php if($v['name']==$find['bankname']){ echo 'selected';}?>><?php echo $v['name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label form-label">银行卡号</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="bankcode" value="<?php echo $find['bankcode']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">微信二维码</label>
                            <div class="col-sm-3">
                                <input type="file" id="dx_file" name="dx_file" onchange="sc('qrcode');" style="display:none"/>
                                <img src="<?php echo $find['qrcode']; ?>" id="imgView" style="height:100px;">
                                <input type="hidden" name="qrcode" value="<?php echo $find['qrcode']; ?>"/>
                                <button type="button" class="btn btn-danger" onclick="dx_file.click()">点击上传</button>
                            </div>
                            <label class="col-sm-2 control-label form-label">微信收款码</label>
                            <div class="col-sm-3">
                                <input type="file" id="dx_file2" name="dx_file2" onchange="sc2('weixinmoneycode');" style="display:none"/>
                                <img src="<?php echo $find['weixinmoneycode']; ?>" id="imgView2" style="height:100px;">
                                <input type="hidden" name="weixinmoneycode" value="<?php echo $find['weixinmoneycode']; ?>"/>
                                <button type="button" class="btn btn-danger" onclick="dx_file2.click()">点击上传</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">支付宝收款码</label>
                            <div class="col-sm-3">
                                <input type="file" id="dx_file3" name="dx_file3" onchange="sc3('zfbmoneycode');" style="display:none"/>
                                <img src="<?php echo $find['zfbmoneycode']; ?>" id="imgView3" style="height:100px;">
                                <input type="hidden" name="zfbmoneycode" value="<?php echo $find['zfbmoneycode']; ?>"/>
                                <button type="button" class="btn btn-danger" onclick="dx_file3.click()">点击上传</button>
                            </div>
                            <label class="col-sm-2 control-label form-label">备注</label>
                            <div class="col-sm-3">
                                <textarea class="form-control" name="remark"><?php echo $find['remark']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>权限控制</b></label>
                            <div class="col-sm-8" style="padding-top:7px;">------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
                        </div>
                        <?php
                        $menu_lists = MenuModel::select("and pid=0");
                        foreach($menu_lists as $v){
                        $auth_name = $v['control']."-".$v['action'];
                        $child = MenuModel::select("and pid=".$v['id']);
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">
                                <input name="auths[]" value="<?php echo $auth_name; ?>" <?php if(in_array($auth_name,$auths)){ echo 'checked';}?> type="checkbox" style="height:15px;"><?php echo $v['name']; ?>
                            </label>
                            <div class="col-sm-8" style="padding-top:7px;">
                                <?php if($child){ foreach($child as $vv){ $auth2_name = $vv['control']."-".$vv['action']; ?>
                                <input name="auths[]" value="<?php echo $auth2_name; ?>" <?php if(in_array($auth2_name,$auths)){ echo 'checked';}?> type="checkbox" style="height:15px;"><?php echo $vv['name']; } }?>
                            </div>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
                                <input type="hidden" name="id" value="<?php echo $find['id']; ?>">
                                <button type="button" class="btn btn-primary" id="sub">提交</button>
                                <button type="button" class="btn btn-default" onclick="javascript:history.back(-1)">返回</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script src="/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/plugins.js"></script>
<!--<script type="text/javascript">edit2</script>-->
<script type="text/javascript">
    //html data-toggle="tooltip" title="必填项"
    //$('[name="name"]').tooltip('show');
    function sc(name){
        var animateimg = $("#dx_file").val(); //获取上传的图片名 带//
        var imgarr=animateimg.split('\\'); //分割
        var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名
        var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置
        var ext = myimg.substring(houzui, myimg.length).toUpperCase();  //切割 . 获取文件后缀
        var file = $('#dx_file').get(0).files[0]; //获取上传的文件
        var fileSize = file.size;           //获取上传的文件大小
        var maxSize = 5348576;              //最大5MB 1MB=1048576
        if(ext !='.PNG' && ext !='.GIF' && ext !='.JPG' && ext !='.JPEG' && ext !='.BMP'){
            $("#tipBtn").click();$("#tipText").html("文件类型错误,请上传图片类型");
            return false;
        }
        if(parseInt(fileSize) >= parseInt(maxSize)){
            $("#tipBtn").click();$("#tipText").html("上传的文件不能超过5MB");
            return false;
        }
        var data = new FormData($('#dx_form')[0]);
        $.ajax({
            url: "/home.php/<?php echo $module; ?>/config/uploadify.html",
            type: 'POST',
            data: data,
            dataType: 'text',
            processData: false,
            contentType: false,
            success:function(res)
            {
                var jsonobj=JSON.parse(res);
                if(jsonobj.code=='success'){
                    var imgUrl = jsonobj.msg;
                    $('#imgView').attr('src',imgUrl);
                    $('[name="'+name+'"]').val(imgUrl);
                }else{
                    $("#tipBtn").click();$("#tipText").html("上传失败");
                }
            }
        });
    }
    function sc2(name){
        var animateimg = $("#dx_file2").val(); //获取上传的图片名 带//
        var imgarr=animateimg.split('\\'); //分割
        var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名
        var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置
        var ext = myimg.substring(houzui, myimg.length).toUpperCase();  //切割 . 获取文件后缀
        var file = $('#dx_file2').get(0).files[0]; //获取上传的文件
        var fileSize = file.size;           //获取上传的文件大小
        var maxSize = 5348576;              //最大5MB 1MB=1048576
        if(ext !='.PNG' && ext !='.GIF' && ext !='.JPG' && ext !='.JPEG' && ext !='.BMP'){
            $("#tipBtn").click();$("#tipText").html("文件类型错误,请上传图片类型");
            return false;
        }
        if(parseInt(fileSize) >= parseInt(maxSize)){
            $("#tipBtn").click();$("#tipText").html("上传的文件不能超过5MB");
            return false;
        }
        var data = new FormData($('#dx_form')[0]);
        $.ajax({
            url: "/home.php/<?php echo $module; ?>/config/uploadify2.html",
            type: 'POST',
            data: data,
            dataType: 'text',
            processData: false,
            contentType: false,
            success:function(res)
            {
                var jsonobj=JSON.parse(res);
                if(jsonobj.code=='success'){
                    var imgUrl = jsonobj.msg;
                    $('#imgView2').attr('src',imgUrl);
                    $('[name="'+name+'"]').val(imgUrl);
                }else{
                    $("#tipBtn").click();$("#tipText").html("上传失败");
                }
            }
        });
    }
    function sc3(name){
        var animateimg = $("#dx_file3").val(); //获取上传的图片名 带//
        var imgarr=animateimg.split('\\'); //分割
        var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名
        var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置
        var ext = myimg.substring(houzui, myimg.length).toUpperCase();  //切割 . 获取文件后缀
        var file = $('#dx_file3').get(0).files[0]; //获取上传的文件
        var fileSize = file.size;           //获取上传的文件大小
        var maxSize = 5348576;              //最大5MB 1MB=1048576
        if(ext !='.PNG' && ext !='.GIF' && ext !='.JPG' && ext !='.JPEG' && ext !='.BMP'){
            $("#tipBtn").click();$("#tipText").html("文件类型错误,请上传图片类型");
            return false;
        }
        if(parseInt(fileSize) >= parseInt(maxSize)){
            $("#tipBtn").click();$("#tipText").html("上传的文件不能超过5MB");
            return false;
        }
        var data = new FormData($('#dx_form')[0]);
        $.ajax({
            url: "/home.php/<?php echo $module; ?>/config/uploadify3.html",
            type: 'POST',
            data: data,
            dataType: 'text',
            processData: false,
            contentType: false,
            success:function(res)
            {
                var jsonobj=JSON.parse(res);
                if(jsonobj.code=='success'){
                    var imgUrl = jsonobj.msg;
                    $('#imgView3').attr('src',imgUrl);
                    $('[name="'+name+'"]').val(imgUrl);
                }else{
                    $("#tipBtn").click();$("#tipText").html("上传失败");
                }
            }
        });
    }
</script>
<!--
$("#tipBtn").click();
$("#tipText").html("");
-->
<button class="btn btn-default" style="display:none;" id="tipBtn" data-toggle="modal" data-target="#tipModal">文字弹窗按钮</button>
<div class="modal fade" id="tipModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">提示信息</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="tipText">在这里添加一些文本</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
                </div>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-default" data-toggle="modal" id="tiperBtn" data-target="#tiperModal" style="display:none;">图片弹窗按钮</button>
<div class="modal fade" id="tiperModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">提示信息</h4>
            </div>
            <div class="modal-body" id="tipZi" style="text-align:center;">文字提示信息内容</div>
            <div class="modal-footer" style="text-align:center;">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function imger(msg){
        var msg = decodeURIComponent(msg);
        $("#tipZi").html("<img style='max-width:400px;' src='"+msg+"' />");
        $("#tiperBtn").click();
    }
</script>

<script type="text/javascript">
    $("#sub").on('click',function(){
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    $("#tipBtn").click();$("#tipText").html("操作成功");
                    setTimeout(function(){
                        window.history.back(-1);
                    },2000);
                }else{
                    $("#tipBtn").click();$("#tipText").html(data);
                }
            }
        });
    });
</script>

</body>
</html>