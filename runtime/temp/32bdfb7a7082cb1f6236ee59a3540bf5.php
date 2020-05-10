<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:55:"./application/merchant/view/merchantrecharge/lists.html";i:1586928867;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;s:71:"/www/wwwroot/nouser/application/merchant/view/merchantrecharge/add.html";i:1586928867;}*/ ?>
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
                    <div class="col-lg-2">
                        <h5>充值方式</h5>
                        <div class="form-group">              
                            <select class="form-control" name="type">
                                <option value="">请选择</option>
                                <?php foreach($enum_type_arr as $k=>$v){?>
                                <option value="<?php echo $k; ?>" <?php if($k==$_GET['type']){ echo 'selected';}?>><?php echo $v; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <h5>状态</h5>
                        <div class="form-group">              
                            <select class="form-control" name="status">
                                <option value="">请选择</option>
                                <?php foreach($enum_status_arr as $k=>$v){?>
                                <option value="<?php echo $k; ?>" <?php if($k==$_GET['status']){ echo 'selected';}?>><?php echo $v; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <h5>搜索</h5>
                        <div class="form-group">              
                            <button type="submit" class="btn btn-success">搜索</button>
                        </div>
                    </div>
                    </form>
                    <div class="col-lg-2">
                        <h5>操作</h5>
                        <div class="form-group">
                            <button class="btn btn-default" data-toggle="modal" data-target="#addModal">充值</button>
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
                <td>充值方式</td>
                <td>充值金额</td>
                <td>交易单号</td>
                <td>交易截图</td>
                <td>状态</td>
                <td>备注信息</td>
                <td>添加时间</td>
              </tr>
            </thead>
            <tbody>
                <?php
                use app\common\model\MerchantrechargeModel;
                foreach($lists as $v){
                $type_name = MerchantrechargeModel::enum_type_text($v['type']);
                $status_name = MerchantrechargeModel::enum_status_text($v['status']);
                ?>
                <tr>
                    <td>
                        <?php echo $type_name; ?>：
                        <?php if($v['type']==1){?>
                        <a href="javascript:;" onclick="javascript:imger('<?php echo urlencode($v['zfbmoneycode']);?>');"><img src="<?php echo $v['zfbmoneycode']; ?>" style="height:32px;"/></a>
                        <?php }else{?>
                        <?php echo $v['bankname']; ?>-<?php echo $v['realname']; ?>-<?php echo $v['bankcode']; }?>
                    </td>
                    <td><?php echo $v['money']; ?></td>
                    <td><?php echo $v['tradeno']; ?></td>
                    <td><a href="javascript:;" onclick="javascript:imger('<?php echo urlencode($v['tradeimg']);?>');"><img src="<?php echo $v['tradeimg']; ?>" style="height:32px;"/></a></td>
                    <td><?php echo $status_name; ?></td>
                    <td><?php if($v['status']==3){echo $v['remark'];}?></td>
                    <td title="处理时间：<?php if(!empty($v['uptime'])){ echo date('Y-m-d H:i:s',$v['uptime']);}?>">
                        <?php echo date('Y-m-d H:i:s',$v['intime']);?>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo $menu_name; ?>-新增</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <form action="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_add.html" class="form-horizontal" method="post" id="dx_form" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding-top:15px;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">充值方式</label>
                            <div class="col-sm-4" style="padding-top:7px;">
                                <?php foreach($enum_type_arr as $k=>$v){?>
                                <input name="type" value="<?php echo $k; ?>"  type="radio" onclick="javascript:chgtype(<?php echo $k; ?>);" <?php if($k==1){ echo 'checked';}?> style="height:15px;"><?php echo $v; }?>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                            </div>

                                <div  class="col-sm-10" style="margin-top: 12px;">
                                    <span id="type2" style="display:none;   color: #f72811;font-size: 16px;font-weight: bold; margin-left: 21%">
                                    <?php echo $find_config['bankname']; ?>-<?php echo $find_config['realname']; ?>-<?php echo $find_config['bankcode']; ?>
                                </span>
                                </div>
                                <div id="type1"  style=" position: absolute; width: 200px;float: right;right: 12%;display: none;"><img  src="<?php echo $find_config['zfbmoneycode']; ?>" style="width: 100%;" ><span style="color: #f72811;text-align: center;display: block;">扫一扫付款</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">充值金额</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="money" value="" placeholder="50元起充">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">交易单号</label>
                            <div class="col-sm-4">
                                <input type="text"  placeholder="填写订单号后6位" class="form-control" name="tradeno" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">充值截图</label>
                            <div class="col-sm-8">
                                <input type="file" id="dx_file" name="dx_file" onchange="sc('tradeimg');" style="display:none"/>
                                <img src="/img/moren.png" id="imgView" style="height:100px;">
                                <input type="hidden" name="tradeimg" value=""/>
                                <button type="button" class="btn btn-danger" onclick="dx_file.click()">点击上传</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
                                <input type="hidden" class="form-control" name="zfbmoneycode" value="<?php echo $find_config['zfbmoneycode']; ?>">
                                <input type="hidden" class="form-control" name="bankname" value="<?php echo $find_config['bankname']; ?>">
                                <input type="hidden" class="form-control" name="realname" value="<?php echo $find_config['realname']; ?>">
                                <input type="hidden" class="form-control" name="bankcode" value="<?php echo $find_config['bankcode']; ?>">
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
    var type2=$("[name='type']:checked").val();
    if(type2==1){
        $("#type1").show();
        $("#type2").hide();
    }
    function chgtype(type){
        if(type==1){
            $("#type1").show();
            $("#type2").hide();
            $("[name='tradeno']").attr('placeholder','填写订单号后6位');
        }
        if(type==2){
            $("#type1").hide();
            $("#type2").show();
            $("[name='tradeno']").attr('placeholder','填写交易单号后6位');
        }
    }
    $("#sub").on('click',function(){
       var money=$('[name=money]').val();
        if(money <50){
            $("#addModal").hide();
            $("#tipBtn").click();
            $("#tipText").html('充值金额最少50！');
            return;
        }
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_add.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    window.location.reload();
                }else{
                    $("#tipBtn").click();$("#tipText").html(data);
                }
            }
        });
    });
</script>


<script type="text/javascript">
    function edit(id,status){
        if(confirm('确定操作吗!')){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit.html',
                dataType:'text',
                data:"id="+id+"&status="+status,
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

</body>
</html>

