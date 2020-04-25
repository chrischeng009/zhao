<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:47:"./application/merchant/view/merchant/index.html";i:1586928868;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo qtitle();?></title>
    <link href="/css/root.css" rel="stylesheet">
    <style type="text/css">
        .carousel-inner > .item > img, .carousel-inner > .item > a > img {
            width: 100%;
            height: 228px;
        }

        .panel > .table-responsive ul {
            list-style: none;
            width: 100%;
            height: 100%;

        }

        .panel > .table-responsive ul li {
            position: relative;
            float: left;
            width: 33.33%;
            height: 81%;
            margin: 20px 0;
            border-right: 1px solid #e0e0e0;
        }

        .panel > .table-responsive ul li:first-child {
            padding: 0 calc((33.33% - 288px) / 2);
        }

        .panel > .table-responsive ul li img {
            float: left;
            width: 80px;
            height: 80px;
            margin-top: 25px;
            margin-right: 6px;
            border-radius: 50%;
            /* margin: 0 4%; */
        }

        .panel > .table-responsive ul li .user-name {
            float: left;
            width: 198px;
            height: 80px;
            padding-top: 18px;
            text-align: left;
        }

        .panel > .table-responsive ul li .user-name span {
            display: inline-block;
            font-size: 16px;
            color: #666;
        }

        .panel > .table-responsive ul li .update {
            position: absolute;
            bottom: 5px;
            left: 50%;
            margin-left: -139px;
            /* width: 180px; */
            height: 25px;
            /* margin-left: 23%; */
        }

        .panel > .table-responsive ul li .update span {
            float: left;
            width: 82px;
            border-radius: 4px;
            color: #fff;
            line-height: 25px;
            background-color: #ff7679;
            margin-right: 16px;
            display: block;
            text-align: center;
            margin-bottom: 8px;
        }

        @media screen and (min-width: 1440px){
            .panel > .table-responsive ul li .update span{
                margin-right: 40px;
            }
        }

        .panel > .table-responsive ul li .update span :last-child {
            /* background-color: #1ecc80; */
            margin-right: 0;

        }

        .panel > .table-responsive ul li .update span a {
            color: #fff;
            width: 100%;
            display: block;
            text-align: center;
        }

        .panel > .table-responsive ul li ul.money {
            padding-top: 18px;
        }

        .panel > .table-responsive ul li ul.money li {
            margin: 0;
            float: left;
            width: 100%;
            height: 30px;
            border-right: none;
            padding-left: 25%;
            text-align: left;
            font-size: 16px;;
        }

        .panel > .table-responsive ul li ul.money li .account-money {
            color: #fd0137;
        }

        .panel > .table-responsive ul li ul.money li .task-dongjie {
            color: #cc9d1e;
        }

        .panel > .table-responsive ul li ul.money li .jifen {
            color: #0cff33;
        }
         .news {
            margin-right: 19px;
        }
         .dynamic {
            width: calc((100% - 20px)/2);
            /*height: 220px;*/
            float: left;
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 30px 27px;
             background: #fff;
        }

       .wrap-border {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 0 6px #e0e0e0;
        }
        .dynamic ul {
            text-align: left;
        }

        .dynamic ul .title{
            height: 30px;
            margin-bottom: 30px;
            border-bottom: 1px solid #eaeaea;
            color: #282828;
            font-weight: bold;
            font-size: 20px;
            line-height: 20px;
        }
        .dynamic ul .title span{
            float: left;
            height: 20px;
            border-left: 2px solid #ff0c40;
            text-indent: 3px;
        }
        .dynamic ul li{
            width: 100%;
            height: 35px;
            color: #282828;
            border-right: none;
            line-height: 15px;
            list-style-type: none;
            cursor: pointer;
        }
        .dynamic ul li:before{
            content: "\2022";
            color: #ff0c40;
            font-size: 16px;
        }
        .dynamic ul li span{
            max-width: 95%;
            margin-left: 5px;
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #tuanchuang .info{
            text-align: center;
            font-size: 16px;
        }
    </style>
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
                        <!--轮播图位置-->

                        <div id="myCarousel" class="carousel slide">
                            <!-- 轮播（Carousel）指标 -->
                            <ol class="carousel-indicators">
                                <?php $a=-1;foreach($banner as $k=>$v){$a++;?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $a; ?>" data-interval="1000"></li>
                                <?php }?>
                            </ol>

                            <!-- 轮播（Carousel）项目 -->
                            <div class="carousel-inner">
                                <?php foreach($banner as $k=>$v){?>
                                <div class="item ">
                                    <img src="<?php echo $v['img']; ?>" alt="<?php echo $v['title']; ?>">
                                </div>
                                <?php }?>
                            </div>
                            <!-- 轮播（Carousel）导航 -->
                        </div>

                        <!--轮播图位置 end-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <ul style=" height: 220px;">
                            <li>
                                <img src="/images/logo.jpg" alt="">
                                <div class="user-name" id="userRank" data-shoprank="0">
                                    <span>用户名:<?php echo $find['mobile']; ?></span>
                                    <span>注册时间:<?php echo date("Y-m-d H:i:s",$find['intime']);?></span>
                                    <span>商家等级： <?php echo $type_name; ?></span>
                                </div>
                                <div class="update">
                                    <span><a href="/home.php/merchant/task/add.html">发布任务</a></span>
                                    <span><a href="/home.php/merchant/merchantrecharge/lists.html">充值</a></span>
                                    <span><a href="/home.php/merchant/merchantcash/lists.html">提现</a></span>
                                    <span><a href="/home.php/merchant/merchantmlogs/lists.html">明细</a></span>
                                    <span><a href="/home.php/merchant/merchantloans/lists.html">贷款</a></span>
                                </div>
                            </li>
                            <li>
                                <ul class="money">
                                    <li>账户余额： <span class="account-money"><?php echo $find['money']; ?></span></li>
                                    <li>任务冻结： <span class="task-dongjie"><?php echo $find['freeze_money']; ?></span></li>
                                    <li>贷款金额： <span class="task-dongjie"><?php echo $find['loans_money']; ?></span></li>
                                    <li>已发任务：<span class="" style="color:red;"><?php echo $hastask; ?></span>&nbsp;|&nbsp;完结任务：<span
                                            class="jifen"><?php echo $finishtask; ?></span></li>
                                </ul>
                            </li>
                            <li>
                                <ul class="money info">
                                    <li>负责导师：<?php echo $findTeacher['name']; ?></li>
                                    <li>微信：<?php echo $findTeacher['weixin']; ?></li>
                                    <li>电话：<?php echo $findTeacher['mobile']; ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wrap-border dynamic news">
                    <ul>
                        <div class="title"><span>最新动态</span></div>
                        <?php foreach($articlearr as $ar=>$at){?>
                        <li onclick="article(<?php echo $at['id']; ?>)"><span><?php echo $at['title']; ?></span></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="wrap-border dynamic">
                    <ul>
                        <div class="title"><span>公告</span></div>
                        <?php foreach($announcearr as $an=>$v){?>
                        <li onclick="article(<?php echo $v['id']; ?>)"><span><?php echo $v['title']; ?></span></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tanchuang" style="padding-top:5%;background: rgba(0, 0, 0, 0.5);overflow-x: hidden;overflow-y: auto;position: fixed;top: 0%;right: 0;bottom: 0;left: 0%;display: none;"></div>

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
<script>
    $(function () {
        // 初始化轮播
        $("#myCarousel").carousel({interval: 3000});
        $('.carousel-indicators li').eq(0).addClass('active');
        $('.carousel-inner > .item').eq(0).addClass('active');
    });
    function article(id) {
        $.ajax({
            type:'POST',
            cache:true,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/article.html',
            dataType:'json',
            data:"id="+id,
            success:function(data){
                $('#tanchuang').show();
             $('#tanchuang').html(
                     '<div class="modal-dialog" style="width:800px;">'+
                         '<div class="modal-content">'+
                             '<div class="modal-header">'+
                                 '<button type="button"  class="close" onClick="guanbi()" >&times;</button>'+
                                 '<h4 class="modal-title">信息展示</h4>'+
                             '</div>'+
                             '<div class="modal-body">'+
                                 '<div class="row">'+
                                     '<div class="col-md-12">'+
                                         '<div class="panel panel-default" style="padding-top:15px;">'+
                                             '<h5 style="text-align: center;">'+data.title+'</h5>'+
                                             '<div class="info" style="padding: 10px;">'+data.content+'</div>'+
                                         '</div>'+
                                         '</div>'+
                                         '</div>'+
                                         '</div>'+
                                         '</div>'+
                                         '</div>'

             );
                }
        });
    }
    function guanbi() {
      $('#tanchuang').hide();
    }
</script>
</body>
</html>

