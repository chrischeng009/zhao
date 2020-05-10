<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:43:"./application/merchant/view/shop/lists.html";i:1588041421;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;s:59:"/www/wwwroot/nouser/application/merchant/view/shop/add.html";i:1586928865;}*/ ?>
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
                    <div class="col-lg-2">
                        <h5>店铺名称</h5>
                        <div class="form-group">              
                            <input type="text" class="form-control" name="name" value="<?php echo $_GET['name']; ?>">
                        </div>
                    </div>
                        <div class="col-sm-2">
                            <h5>所属分类</h5>
                            <div class="form-group">
                                <select class="form-control" name="category_id">
                                    <option value="">请选择</option>
                                    <?php foreach($category_list as $v){?>
                                    <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$_GET['category_id']){ echo 'selected';}?>><?php echo $v['name']; ?></option>
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
                            <button class="btn btn-default" data-toggle="modal" data-target="#addModal">绑定店铺</button>
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
                <td width="60">Id</td>
                <td>店铺名称</td>
                <td>旺旺号</td>
                <td>店铺网址</td>
                <td>状态</td>
                <td>分类</td>
                <td>添加时间</td>
                <td>操作</td>
              </tr>
            </thead>
            <tbody>
                <?php
                use app\common\model\ShopModel;
                use app\common\model\ShopcategoryModel;
                foreach($lists as $v){
                $status_name = ShopModel::enum_status_text($v['status']);
                  if($v['category_id']){
                $cate_name = ShopcategoryModel::find(" and id=".$v['category_id']);
                }else{
                $cate_name['name']='';
                }
                ?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['wangwang']; ?></td>
                    <td><a target="_blank" href="<?php echo $v['url']; ?>"><?php echo mb_substr($v['url'],0,30);?>....</a></td>
                    <td><?php echo $status_name; ?></td>
                    <td><?php echo $cate_name['name']; ?></td>
                    <td><?php echo date('Y-m-d',$v['intime']);?></td>
                    <td>
                        <?php if( $v['status']==1){?>
                        <a href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/edit.html?id=<?php echo $v['id']; ?>"><span class="label label-primary">编辑</span></a>
                         <?php }?>
                      <!--  <a href="javascript:;" onclick="act_del(<?php echo $v['id']; ?>)"><span class="label label-danger">删除</span></a>-->
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
                            <label class="col-sm-2 control-label form-label">店铺名称</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">旺旺号</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="wangwang" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">店铺网址</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="url" value="http://">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">备注</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="remark"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">所属分类</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category_id">
                                    <option value="">请选择</option>
                                    <?php foreach($category_list as $v){?>
                                    <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
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
    $("#sub").on('click',function(){
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_add.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    $("#tipBtn").click();$("#tipText").html("操作成功");
                    $('#addModal').hide();
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                }else{
                    $("#tipBtn").click();$("#tipText").html(data);
                }
            }
        });
    });
</script>


<script type="text/javascript">
    
    
</script>
<script type="text/javascript">
    function act_del(id){
        if(confirm('确定操作吗!')){
            $.ajax({
                type:'POST',
                cache:false,
                url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_del.html',
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

