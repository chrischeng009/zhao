<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:44:"./application/merchant/view/order/lists.html";i:1586928867;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;s:61:"/www/wwwroot/nouser/application/merchant/view/order/edit.html";i:1586928866;s:68:"/www/wwwroot/nouser/application/merchant/view/order/editcomment.html";i:1586928866;}*/ ?>
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
        <a href="/home.php/merchant/merchant/index.html" class="logo">商家端</a>
    </div>
    <a href="javascript:;" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="javascript:;" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <ul class="topmenu" style="padding-left:20px;">
        <li><a href="/home.php/merchant/merchant/index.html">首页</a></li>
    </ul>
    <ul class="top-right">
        <li class="dropdown link">
            <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle profilebox">
                <img src="/img/profileimg.png" alt="img"><b style="color:#fff;"><?php echo $_SESSION['merchant_mobile']; ?></b><span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
                <li><a href="/home.php/merchant/merchant/edit_password.html"><i class="fa falist fa-lock"></i>修改密码</a></li>
                <li><a href="/home.php/merchant/merchant/edit_self.html"><i class="fa falist fa-user"></i>修改资料</a></li>
                <li><a href="/home.php/merchant/merchant/logout.html"><i class="fa falist fa-power-off"></i> 退出</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="sidebar clearfix">
    <ul class="sidebar-panel nav">
        <!--li class="sidetitle">MENU</li-->
        <?php
        use app\common\model\MerchantmenuModel;
        use app\common\model\MerchantModel;
        $module = request()->module();
        $control = strtolower(request()->controller());
        $action = request()->action();
        $find_menu = MerchantmenuModel::find("and control='".$control."' and action='".$action."'");
        $menu_name = isset($find_menu['name'])?$find_menu['name']:"菜单未配置";
        $findMerchant = MerchantModel::find("and id='".$_SESSION['merchant_id']."'");
        $authArr = !empty($findMerchant['auths'])?json_decode($findMerchant['auths'],true):[];
        $authArr = [];
        
        $menu_lists = MerchantmenuModel::select("and pid=0");
        foreach($menu_lists as $v){
        $auth_name = $v['control']."-".$v['action'];
        $findMenu = MerchantmenuModel::find("and control='".$control."' and action='".$action."'");
        $active = '';
        $display = '';
        if($v['id']==$findMenu['pid']){ $active='active'; $display='display:block';}
        $child = MerchantmenuModel::select("and isshow=1 and pid=".$v['id']);
        if(!in_array($auth_name,$authArr) && $v['isshow']==1){
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
                if(in_array($auth2_name,$authArr) || 1==1){
                ?>
                <li>
                    <a href="/home.php/merchant/<?php echo $vv['control']; ?>/<?php echo $vv['action']; ?>.html"><?php echo $vv['name']; ?></a>
                </li>
                <?php  } }}?>
            </ul>
        </li>
        <?php } }?>
    </ul>
</div>

<div class="content">
    <?php if(empty($_GET['abc'])){?>
    <div class="page-header">
        <h1 class="title"><?php echo $menu_name; ?></h1>
    </div>
    <?php }?>
<div class="container-padding">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/lists.html" method="get" autocomplete="off">
                    <?php if(empty($_GET['abc'])){?>
                    <div class="col-sm-1">
                        <h5>订单类型</h5>
                        <div class="form-group">              
                            <select class="form-control" name="type">
                                <option value="">请选择</option>
                                <?php foreach($enum_type_arr as $k=>$v){?>
                                <option value="<?php echo $k; ?>" <?php if($k==$_GET['type']){ echo 'selected';}?>><?php echo $v; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <h5>店铺名</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="shop_name" value="<?php echo $_GET['shop_name']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <h5>旺旺号</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="tbcode" value="<?php echo $_GET['wangwang']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <h5>任务编码</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="verifycode" value="<?php echo $_GET['verifycode']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <h5>开始时间</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="starttime" value="<?php echo $_GET['starttime']; ?>" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd',onpicked:null})">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <h5>结束时间</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="lasttime" value="<?php echo $_GET['lasttime']; ?>" onclick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd',onpicked:null})">
                        </div>
                    </div>
                        <div class="col-sm-1">
                            <h5>分页条数</h5>
                            <select class="form-control" name="limit">
                                <option value="" >请选择</option>
                                <option value="30" <?php if($limit==30) echo 'selected="selected"'?> >30</option>
                                <option value="50" <?php if($limit==50)echo 'selected="selected"'?> >50</option>
                                <option value="100" <?php if($limit==100) echo 'selected="selected"'?>>100</option>
                            </select>
                        </div>
                    <?php }?>
                    <div class="col-sm-3" >
                        <h5>操作</h5>
                        <div class="form-group">
                            <?php if(empty($_GET['abc'])){?>
                            <button type="submit" class="btn btn-success">搜索</button>
                            <?php }else{?>
                            <button type="button" class="btn btn-success" onclick="javascript:history.back(-1)">返回</button>
                            <button type="button" class="btn btn-danger" id="offBtn">下架</button>
                            <?php }?>
                            <a target="_blank" href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/export.html?<?php echo http_build_query($_GET);?>" class="btn btn-default">导出</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead>
                <tr >
                    <td>今日总金额 ：<font><?php echo $todypayprice+$todywithout_price; ?></font></td>
                    <td>今日完成单数 ：<font><?php echo $todyorder; ?></font></td>
                    <td>今日本金 ：<font><?php echo $todypayprice; ?></font></td>
                    <td>今日总服务费 ：<font><?php echo $todywithout_price; ?></font></td>
                    <td>今日退款总金额 ：<font><?php echo $todyrefund+$todyrefundwithout_price; ?></font></td>
                    <td>今日退款本金 ：<font><?php echo $todyrefund; ?></font></td>
                    <td>今日退款总服务费 ：<font><?php echo $todyrefundwithout_price; ?></font></td>
                </tr>
                </thead>
                </table>
            </div>
            </div>
    </div>
        </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
                <tr>
                    <td><input type="checkbox" name="sel_all" onclick="selectAllid(this)" style="height:15px;"/></td>
                    <td>编码</td>
                    <td>上架时间</td>
                    <td>完成时间</td>
                    <td>店铺</td>
                    <td>主图</td>
                    <td>关键词</td>
                    <td>单价</td>
                    <td>实际下单价</td>
                    <td>服务费</td>
                    <td>礼品</td>
                    <!--<td>订单截图</td>-->
                    <!--<td>手机号</td>-->
                    <td>旺旺号</td>
                    <td>类型</td>
                    <td>订单状态</td>
                    <td>异常信息</td>
                    <td>评价状态</td>
                    <td>评价反馈</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                use app\common\model\ShopModel;
                use app\common\model\TaskModel;
                use app\common\model\TaskdetailModel;
                use app\common\model\OrderModel;
                foreach($lists as $v){
                $find_task = TaskModel::find("and id=".$v['task_id']);
                $find_taskdetail = TaskdetailModel::find("and id=".$v['taskdetail_id']);
                $find_shop = ShopModel::find("and id=".$v['shop_id']);
                $type_name = OrderModel::enum_type_text($v['type']);
                $task_status_name = TaskModel::enum_status_text($find_task['status']);
                $status_name = '';
                if($v['type']==1){
                    $status_name = OrderModel::enum_status1_text($v['status1']);
                }
                if($v['type']==2){
                    $status_name = OrderModel::enum_status2_text($v['status2']);
                }
                if($v['type']==3){
                    $status_name = OrderModel::enum_status3_text($v['status3']);
                }
                    $comment = OrderModel::enum_comment_text($v['iscomment']);
                ?>
                <tr>
                    <td><input name="id" value="<?php echo $v['id']; ?>" type="checkbox" style="height:15px;"></td>
                    <td><?php echo $v['verifycode']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['intime']);?></td>
                    <td><?php if($v['finishtime']){ echo date('Y-m-d H:i:s',$v['finishtime']);}?></td>
                    <td><?php echo $v['shop_name']; ?></td>
                    <td><a href="javascript:;" onclick="javascript:imger('<?php echo urlencode($find_task['mainimage']);?>');"><img src="<?php echo $find_task['mainimage']; ?>" style="height:30px;"/></a></td>
                    <td><?php echo $find_taskdetail['searchkeywords']; ?></td>
                    <td><?php echo $v['price']; ?></td>
                    <td><?php echo $v['payprice']; ?></td>
                    <td><?php echo $v['without_price']; ?></td>
                    <td><?php echo $find_task['present']; ?></td>
                    <!--<td><a href="javascript:;" onclick="javascript:imger('<?php echo urlencode($v['payimage']);?>');"><img src="<?php echo $v['payimage']; ?>" style="height:30px;"/></a></td>-->
                    <!--<td><?php echo $v['mobile']; ?></td>-->
                    <td><?php echo $v['wangwang']; ?></td>
                    <td><?php echo $type_name; ?></td>
                    <td><?php echo $task_status_name; ?>-<?php echo $status_name; ?></td>
                    <td><?php echo $v['exceptioninfo']; ?></td>
                    <td><?php echo $comment; ?></td>
                    <td><?php echo $v['commentremark']; ?></td>
                    <td>
                        <?php if($v['type']==1 && in_array($find_task['status'],[2,3,6,7]) && in_array($v['status1'],[4])){?>
                        <a href="javascript:;" onclick="javascript:edit(<?php echo $v['id']; ?>);"><span class="label label-warning">异常</span></a>
                        <?php }if(  in_array($v['type'],[1,3]) && in_array($find_task['status'],[2,3,6,7]) && in_array($v['status1'],[4]) && $v['iscomment']==1){?>
                        <a href="javascript:;" onclick="javascript:editcomment(<?php echo $v['id']; ?>);"><span class="label label-default">评价</span></a>
                        <?php }if($v['type']==1 && in_array($v['status1'],[1,2,3]) && in_array($find_task['status'],[3])){?>
                        <a href="javascript:;" onclick="javascript:edit_refundoff(<?php echo $v['id']; ?>);"><span class="label label-danger">下架</span></a>
                        <?php }?>
                        <a href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/view.html?id=<?php echo $v['id']; ?>"><span class="label label-info">详情</span></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
          </table>
        </div>
          <?php echo $page_show; ?>
      </div>
    </div>
  </div>
</div>
    </div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script src="/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/plugins.js"></script>
<script type="text/javascript" src="/js/layer/layer.js"></script>
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
    $('body,html').animate({scrollTop:0},1000);
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

<button class="btn btn-default" style="display:none;" id="confirmBtn" data-toggle="modal" data-target="#confirmModal">文字确认弹窗按钮</button>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">提示信息</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="confirmText">在这里添加一些文本</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmSub">确认提交</button>
                    <button type="button" class="btn btn-default" id="confirmColse" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-default" style="display: none;position: fixed;top:50%;right: 0"  id="tishiBtn" data-toggle="modal" data-target="#tishiModal">您有新的消息</button>
<div class="modal fade" id="tishiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="tishiColse" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">新消息提示</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="tishiText">
                </div>
                <!--<div class="modal-footer">-->
                    <!--&lt;!&ndash;<button type="button" class="btn btn-danger" id="confirmColse">确认提交</button>&ndash;&gt;-->
                    <!--&lt;!&ndash;<button type="button" class="btn btn-default" id="tishiColse" data-dismiss="modal">确定</button>&ndash;&gt;-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<script>
    var fromid=<?php echo $_SESSION['merchant_id']; ?>;
    //创建websocket 对象
    var ws = new WebSocket("ws://127.0.0.1:8282");
    //从服务器收到消息时，该监听器将被调用
    ws.onmessage = function(e){
        var message = eval('('+e.data+')');
        switch (message.type){
            case 'init':
                var bind ='{"type":"bind","fromid":"'+fromid+'"}';
                ws.send(bind);
                return;
            case 'text':
                $("#tishiBtn").show();
                    console.log(message.data);
//                $("#tishiText ").text("");
                $("#tishiText ").append("<span style='width: 100%;'>"+message.data+"</span><br />");
                return;
            case 'save':
                save_message(message);
                return;
        }

    }

    //当连接关闭时，则触发
    ws.onclose = function(e) {
        console.log(e);
    };

//    /**
//     * GET取值,用于接受？传值 可接收汉字 推荐使用
//     */
//    function getUrlParam(name){
//        // 用该属性获取页面 URL 地址从问号 (?) 开始的 URL（查询部分）
//        var url = window.location.search;
//        // 正则筛选地址栏
//        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
//        // 匹配目标参数
//        var result = url.substr(1).match(reg);
//        //返回参数值
//        return result ? decodeURIComponent(result[2]) : null;
//    }
    $(document).ready(function(){
        $.post(
                "/home.php/api/chat/search.html",
                '',
                function (data) {
                    if(data.msg=='1'){
                        $("#tishiBtn").show();
                        var html=[];
                        if(data.res.length >0) {
                            for (var i = 0; i < data.res.length; i++) {
                                var b=i+1;
                                html += "<span style='width: 100%;'>" +b+'.' + data.res[i].content + "</span> <br />";
                            }
                        }
                        $("#tishiText ").html(html);
                    }else{
//                        $("#tishiText ").html('暂无任何消息！');
                        return;
                    }
                },'json'
        )
        $("#tishiBtn").on('click',function(){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/api/chat/edit.html',
                dataType:'text',
                data: "",
                success:function(data)
                {
                    $("#tishiBtn").hide();
                }
            });
        });
    });

</script>
<script type="text/javascript">
    function imger(msg){
        var msg = decodeURIComponent(msg);
        $("#tipZi").html("<img style='max-width:400px;' src='"+msg+"' />");
        $("#tiperBtn").click();
    }
</script>
<button class="btn btn-default" data-toggle="modal" id="editBtn" data-target="#editModal" style="display:none;">编辑</button>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">编辑</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <form action="" class="form-horizontal" method="post" id="dx_form" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding-top:15px;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">订单类型</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="type">
                                    <?php foreach($enum_type_arr as $k=>$v){ if($k!=1){?>
                                    <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">异常信息</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="exceptioninfo"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">订单截图</label>
                            <div class="col-sm-8">
                                <input type="file" id="dx_file" name="dx_file" onchange="sc('tkimage');" style="display:none"/>
                                <img src="/img/moren.png" id="imgView" style="height:100px;">
                                <input type="hidden" name="tkimage" value=""/>
                                <button type="button" class="btn btn-danger" onclick="dx_file.click()">点击上传</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
                                <input type="hidden" class="form-control" name="id" value="">
                                <button type="button" class="btn btn-primary" id="sub">提交</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function edit(id){
        $("#editBtn").click();
        $("[name=id]").val(id);
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_find.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                var res = JSON.parse(data);
                $("[name=exceptioninfo]").val(res.exceptioninfo);
            }
        });
    }
    $("#sub").on('click',function(){
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit_exceptioninfo.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    window.location.reload();
                }else{
                    $("#tipBtn").click();$("#tipText").html(data);
                    $("#editModal").hide();
                }
            }
        });
    });
</script>

<button class="btn btn-default" data-toggle="modal" id="editBtn2" data-target="#editModal2" style="display:none;">评论</button>
<div class="modal fade" id="editModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">评论</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <form action="" class="form-horizontal" method="post" id="dx_form2" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding-top:15px;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"></label>
                            <div class="col-sm-8" style="color:#d21d03"> 提示：评价旺旺号必须显示物流已到货才能评介！！！</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">评语</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">上传多图</label>
                            <div class="col-lg-8">
                                <input type="file" id="dx_file5" name="dx_file5" onchange="img('pic');" style="display:none"/>
                                <button type="button" class="btn btn-danger" onclick="dx_file5.click()">点击上传</button>
                                <div id="imgView5">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">评价视频</label>
                            <div class="col-sm-8">
                                <input type="file" id="dx_file6" name="dx_file6" onchange="video('pjvideo');" style="display:none"/>
                                <button type="button" class="btn btn-info" onclick="dx_file6.click()">点击上传</button>
                                <div id="imgView6">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
                                <input type="hidden" class="form-control" name="id" value="">
                                <button type="button" class="btn btn-primary" id="sub2">提交</button>
                                <button   type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function editcomment(id){
        $("[name=id]").val(id);
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/iscomment.html',
            dataType:'text',
            data:"id="+id,
            success:function(data)
            {
                if(data=='success'){

                    $("#editBtn2").click();
                }else{
                    $("#tipBtn").click();$("#tipText").html(data);
                    $("#editModal2").hide();
                }
            }
        });
    }
    $("#sub2").on('click',function(){
        var comment= $("[name=comment]").val();
        var pic=$("[name='pic[]']").val();
        var video= $("[name=video]").val();
        if(comment==''){
            layer.msg("评语不能为空！", {icon: 7});
            return false;
        }
//        if(pic==undefined){
//            layer.msg("请上传多图！", {icon: 7});
//            return false;
//        }
//        if(video==undefined){
//            layer.msg("请上传视频！", {icon: 7});
//            return false;
//            return false;
//        }
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_comment.html',
            dataType:'text',
            data:$("#dx_form2").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    window.location.reload();
                }else{
                    $("#tipBtn").click();$("#tipText").html(data);
                    $("#editModal2").hide();
                }
            }
        });
    });
//    删除
    $("#dx_form2").on('click', '[rel=del]', function () {
     var i=$(this).attr('data-value');
     var order_id=$(this).attr('data-order');
        $(this).parent().remove();
       $.ajax({
           type: 'POST',
           cache: false,
           url: '/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_comment_del.html',
           dataType: 'text',
           data: "pic="+i+"&order_id="+order_id,
           success: function (data) {
               if (data == 'success') {
//                   window.location.reload();
               } else {
                   $("#tipBtn").click();
                   $("#tipText").html(data);
               }
           }
       });
   });
    function img(name){
        var animateimg = $("#dx_file5").val(); //获取上传的图片名 带//
        var imgarr=animateimg.split('\\'); //分割
        var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名
        var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置
        var ext = myimg.substring(houzui, myimg.length).toUpperCase();  //切割 . 获取文件后缀
        var file = $('#dx_file5').get(0).files[0]; //获取上传的文件
        var fileSize = file.size;           //获取上传的文件大小
        var maxSize = 1048576;              //最大5MB 1MB=1048576
        if($('[name="pic[]"]').length >4){
            $("#editModal2").hide();
            $("#tipBtn").click();$("#tipText").html("上传图片不能超过5张！");
            return false;
        }
        if(ext !='.PNG' && ext !='.GIF' && ext !='.JPG' && ext !='.JPEG' && ext !='.BMP'){
            $("#editModal2").hide();
            $("#tipBtn").click();$("#tipText").html("文件类型错误,请上传图片类型");
            return false;
        }
        if(parseInt(fileSize) >= parseInt(maxSize)){
            $("#editModal2").hide();
            $("#tipBtn").click();$("#tipText").html("上传的文件不能超过1MB");
            return false;
        }
        var data = new FormData($('#dx_form2')[0]);
        $.ajax({
            url: "/home.php/<?php echo $module; ?>/config/uploadify5.html",
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
                    var html='<div class="pic col-sm-3"><input type="hidden" name="pic[]" '+'value='+ imgUrl+'>'+
                            '<img src="'+imgUrl+'"style="width:100px;float: left" /><button type="button" class="del btn btn-success" rel="del" data-value="'+imgUrl+'">删除</button></div>';
                    $('#imgView5').append(html);
                }else{
                    $("#tipBtn").click();$("#tipText").html("上传失败");
                }
            }
        });
    }
    function video(name){
        var animateimg = $("#dx_file6").val(); //获取上传的图片名 带//
        var imgarr=animateimg.split('\\'); //分割
        var myimg=imgarr[imgarr.length-1]; //去掉 // 获取图片名
        var houzui = myimg.lastIndexOf('.'); //获取 . 出现的位置
        var ext = myimg.substring(houzui, myimg.length).toUpperCase();  //切割 . 获取文件后缀
        var file = $('#dx_file6').get(0).files[0]; //获取上传的文件
        var fileSize = file.size;           //获取上传的文件大小
        var maxSize = 5348576;              //最大5MB 1MB=1048576
        if(ext !='.MP4' && ext !='.MOV' && ext !='.FLY' && ext !='.TS'){
            $("#editModal2").hide();
            $("#tipBtn").click();$("#tipText").html("文件类型错误,请上传文件类型");
            return false;
        }
        if(parseInt(fileSize) >= parseInt(maxSize)){
            $("#editModal2").hide();
            $("#tipBtn").click();$("#tipText").html("上传的文件不能超过5MB");
            return false;
        }
        var data = new FormData($('#dx_form2')[0]);
        $.ajax({
            url: "/home.php/<?php echo $module; ?>/config/uploadify6.html",
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
                    var html='<div class="video"><input type="hidden" name="video" '+'value='+ imgUrl+'>'+
                    '<video src="'+imgUrl+'"  style="width:100px;height:100px;float: left" controls="controls" autoplay loop></video><button class="del btn btn-success" rel="del" data-value="'+imgUrl+'"">删除</i></div>';
                    $('#imgView6').append(html);
//                    document.getElementById("videoid").play();
                }else{

                    $("#tipBtn").click();$("#tipText").html("上传失败");
                }
            }
        });
    }
</script>


<script src="/js/dateCalendar/WdatePicker.js"></script>
<script type="text/javascript">
    function checkallid(){
        var str="";
        $("[name='id']:checked").each(function(){
            str= str + $(this).val()+',';
        });
        return str.substring(0,str.length-1);
    }
    function selectAllid(a){
        $("[name='id']").each(function(){
            return this.checked = a.checked ? "checked": "";
        });
        $("[name='sel_all']").each(function(){
            return this.checked = a.checked ? "checked": "";
        });
    }
    $('#offBtn').bind('click',function(){
        if(checkallid()==''){
            $("#tipBtn").click();$("#tipText").html("请选择订单对象");
            return false;
        }
        if(confirm('确认下架此任务，请联系业务员审核下架!')){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit_refundoff.html',
                dataType:'text',
                data:"id="+checkallid(),
                success:function(data){
                    if(data=='success'){
                        $("#tipBtn").click();$("#tipText").html("操作成功");
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }else{
                        $("#tipBtn").click();$("#tipText").html(data);
                    }
                }
            });
        }
    });
   function edit_refundoff(id){
        if(confirm('确认下架此任务，请联系业务员审核下架!')){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit_refundoff.html',
                dataType:'text',
                data:"id="+id,
                success:function(data){
                    if(data=='success'){
                        $("#tipBtn").click();$("#tipText").html("操作成功");
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }else{
                        $("#tipBtn").click();$("#tipText").html(data);
                    }
                }
            });
        }
    }
</script>

</body>
</html>

