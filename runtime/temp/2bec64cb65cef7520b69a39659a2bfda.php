<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:43:"./application/merchant/view/task/lists.html";i:1586928865;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo qtitle();?></title>
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
    <div class="page-header">
        <h1 class="title"><?php echo $menu_name; ?></h1>
    </div>
<div class="container-padding">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/lists.html" method="get" autocomplete="off">
                    <div class="col-lg-1">
                        <h5>审核状态</h5>
                        <div class="form-group">              
                            <select class="form-control" name="status">
                                <option value="">请选择</option>
                                <?php foreach($enum_status_arr as $k=>$v){?>
                                <option value="<?php echo $k; ?>" <?php if($k==$_GET['status']){ echo 'selected';}?>><?php echo $v; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <h5>店铺名</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="shop_name" value="<?php echo $_GET['shop_name']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <h5>Id</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="tasksn" value="<?php echo $_GET['tasksn']; ?>">
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
                    <div class="col-lg-1">
                        <h5>搜索</h5>
                        <div class="form-group">              
                            <button type="submit" class="btn btn-success">搜索</button>
                        </div>
                    </div>
                    </form>
                    <div class="col-lg-2">
                        <h5>操作</h5>
                        <div class="form-group">
                            <a href="javascript:;" onclick="javascript:copy_task();" class="btn btn-success">复制</a>
                            <a href="javascript:;" onclick="javascript:pay_task();" class="btn label-danger" style="color: #fff">付款</a>
                            <a href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/add.html" class="btn btn-default">发布任务</a>
                        </div>
                    </div>
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
                <td>Id</td>
                <td>发布时间</td>
                <td>店铺名</td>
                <td>主图</td>
                <td>宝贝详情</td>
                <td>任务本金/数量/预估服务费</td>
                <td>赠送礼品</td>
                <td>完成金额/数量/已扣服务费</td>
                <td>未完金额/数量/服务费</td>
                <td>任务状态</td>
                <td>订单类型</td>
                <td>操作</td>
              </tr>
            </thead>
            <tbody>
                <?php
                use app\common\model\ShopModel;
                use app\common\model\OrderModel;
                use app\common\model\TaskModel;
                foreach($lists as $v){
                $find_shop = ShopModel::find("and id=".$v['shop_id']);
                $status_name = TaskModel::enum_status_text($v['status']);
                $worktype_name = TaskModel::enum_worktype_text($v['worktype']);
                $orderArr = OrderModel::get_total($v['id']);
                ?>
                <tr>
                    <td><input name="id" value="<?php echo $v['id']; ?>" type="checkbox" style="height:15px;"></td>
                    <td><?php echo $v['tasksn']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['intime']);?></td>
                    <td><?php echo $find_shop['name']; ?></td>
                    <td><a href="javascript:;" onclick="javascript:imger('<?php echo urlencode($v['mainimage']);?>');"><img src="<?php echo $v['mainimage']; ?>" style="height:30px;"/></a></td>
                    <td><a href="<?php echo $v['goodsurl']; ?>" target="_blank"><?php echo $v['goodstitle']; ?></a></td>
                    <td><?php echo $v['money']; ?>/<?php echo $v['num']; ?>/<?php echo $v['without_money']; ?></td>
                    <td><?php echo $v['present']; ?></td>
                    <td><?php echo $orderArr['money']; ?>/<?php echo $orderArr['num']; ?>/<?php echo $orderArr['without_money']; ?></td>
                    <td><?php echo round($v['money']-$orderArr['money'],2)?>/<?php echo $v['num']-$orderArr['num']; ?>/<?php echo $v['without_money']-$orderArr['without_money']; ?></td>
                    <td><?php echo $status_name; ?></td>
                    <td><?php echo $worktype_name; ?></td>
                    <td>
                        <a href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/view.html?id=<?php echo $v['id']; ?>"><span class="label label-info">详情</span></a>
                        <a href="/home.php/<?php echo $module; ?>/order/lists.html?task_id=<?php echo $v['id']; ?>&abc=1&intime=<?php echo date('Y-m-d',$v['intime']);?>&shopname=<?php echo $find_shop['name']; ?>"><span class="label label-default">订单</span></a>
                        <?php if($v['status']==1){?>
                        <a href="javascript:;" onclick="javascript:edit_status2(<?php echo $v['id']; ?>);"><span class="label label-danger">付款</span></a>
                        <?php }if($v['status']==1){?>
                        <a href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/edit.html?id=<?php echo $v['id']; ?>" ><span class="label label-warning">修改</span></a>
                        <?php }if($v['status']==3){?>
                        <a href="javascript:;" onclick="javascript:edit_refundoff(<?php echo $v['id']; ?>);"><span class="label label-danger">下架</span></a>
                        <?php }?>
                        <a href="javascript:;" onclick="javascript:add_task(<?php echo $v['id']; ?>);"><span class="label label-success">复制</span></a>
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
    function copy_task() {
        if (checkallid() == '') {
            $("#tipBtn").click();
            $("#tipText").html("请选择订单对象");
            return false;
        }
        console.log(checkallid());
        if (confirm('确定复制此任务吗')) {
            $.ajax({
                type: 'POST',
                cache: false,
                url: '/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_add_task.html',
                dataType: 'text',
                data: "id=" + checkallid(),
                success: function (data) {
                    if (data == 'success') {
                        $("#tipBtn").click();
                        $("#tipText").html("操作成功");
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $("#tipBtn").click();
                        $("#tipText").html(data);
                    }
                }
            });
        }
    }
 function pay_task() {
        if (checkallid() == '') {
            $("#tipBtn").click();
            $("#tipText").html("请选择订单对象");
            return false;
        }
        console.log(checkallid());
        if (confirm('确定要付款吗')) {
            $.ajax({
                type: 'POST',
                cache: false,
                url: '/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit_status2.html',
                dataType: 'text',
                data: "id=" + checkallid(),
                success: function (data) {
                    if (data == 'success') {
                        $("#tipBtn").click();
                        $("#tipText").html("操作成功");
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $("#tipBtn").click();
                        $("#tipText").html(data);
                    }
                }
            });
        }
    }

    function edit_status2(id){
        if(confirm('确定付款吗!')){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit_status2.html',
                dataType:'text',
                data:"id="+id,
                success:function(data){
                    if(data=='success'){
                        window.location.reload();
                    }else{
                        $("#tipBtn").click();$("#tipText").html(data);
                    }
                }
            });
        }
    }

</script>
<script type="text/javascript">
    function add_task(id){
        if(confirm('确定要复制任务吗!')){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_add_task.html',
                dataType:'text',
                data:"id="+id,
                success:function(data){
                    if(data=='success'){
                        $("#confirmColse").click();$("#tipBtn").click();$("#tipText").html("复制成功");
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                    else{
                            $("#tipBtn").click();
                        if(data=='error'){
                            $("#tipText").html('余额不足，请充值！');
                        }else {
                            $("#tipText").html(data);
                        }
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);


                    }
                }
            });
        }
    }
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

