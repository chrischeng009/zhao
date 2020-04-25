<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./application/merchant/view/task/view.html";i:1586928865;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;}*/ ?>
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
<style>.col-sm-3{padding-top:7px;}</style>
<div class="content">
    <div class="page-header">
        <h1 class="title"><?php echo $menu_name; ?></h1>
    </div>
    <div class="container-padding">
        <div class="row">
            <form action="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_add.html" class="form-horizontal" method="post" id="dx_form" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding-top:15px;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">商家手机号</label>
                            <div class="col-sm-3"><?php echo $find_merchant['mobile']; ?></div>
                            <label class="col-sm-2 control-label form-label">店铺</label>
                            <div class="col-sm-3"><?php echo $find_shop['name']; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">发布时间</label>
                            <div class="col-sm-3"><?php echo date("Y-m-d H:i:s",$find['intime']);?></div>
                            <label class="col-sm-2 control-label form-label">订单生效日期</label>
                            <div class="col-sm-3"><?php echo date("Y-m-d",$find['worktime']);?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">任务本金</label>
                            <div class="col-sm-3"><?php echo $find['money']; ?></div>
                            <label class="col-sm-2 control-label form-label">数量</label>
                            <div class="col-sm-3"><?php echo $find['num']; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">服务费</label>
                            <div class="col-sm-3"><?php echo $find['without_money']; ?></div>
                            <label class="col-sm-2 control-label form-label">总金额</label>
                            <div class="col-sm-3"><?php echo $find['total_money']; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">权重类目号</label>
                            <div class="col-sm-3"><?php echo $cat_name; ?></div>
                            <label class="col-sm-2 control-label form-label">标签词</label>
                            <div class="col-sm-3"><?php echo $find['tags']; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">商品标题</label>
                            <div class="col-sm-3"><?php echo $find['goodstitle']; ?></div>
                            <label class="col-sm-2 control-label form-label">商品链接</label>
                            <div class="col-sm-3"><a href="<?php echo $find['goodsurl']; ?>" target="_blank"><?php echo $find['goodsurl']; ?></a></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">商品主图</label>
                            <div class="col-sm-3">
                                <a href="javascript:;" onclick="javascript:imger('<?php echo urlencode($find['mainimage']);?>');"><img src="<?php echo $find['mainimage']; ?>" style="height:100px;"></a>
                            </div>
                            <label class="col-sm-2 control-label form-label">拍下规格</label>
                            <div class="col-sm-3">
                                <?php if($find['isattr']==2){ echo '任意规格';}?><?php echo $find['attrcolor']; ?>&nbsp;<?php echo $find['attrsize']; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">付款方式</label>
                            <div class="col-sm-3">花呗付款：<?php echo $ishuabei_name; ?>&nbsp;&nbsp;&nbsp;信用卡付款：<?php echo $iscredit_name; ?></div>
                            <label class="col-sm-2 control-label form-label">赠品</label>
                            <div class="col-sm-3"><?php echo $find['present']; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">Id</label>
                            <div class="col-sm-3"><?php echo $find['tasksn']; ?></div>
                            <!--<label class="col-sm-2 control-label form-label">付款时间</label>-->
                            <!--<div class="col-sm-3"><?php if($find['paytime']){ echo date("Y-m-d H:i:s",$find['paytime']);}?></div>-->
                            <label class="col-sm-2 control-label form-label">是否按时间段派单</label>
                            <div class="col-sm-3"><?php if($find['istime']==2){ echo '是';}else{echo '否';}?></div>
                        </div>
                        <?php if($find['istag']==2){?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">竟品宝贝关键词：</label>
                            <div class="col-sm-3"><?php echo $find['tagkeyworks']; ?></div>
                            <label class="col-sm-2 control-label form-label">竟品宝贝链接：</label>
                            <div class="col-sm-3"><?php echo $find['tagurl']; ?></div>
                        </div>
                        <?php }                        use app\common\model\ConfigModel;
                        foreach($taskdetail_list as $v){
                        $istalk_name = ConfigModel::enum_isnot_text($v['istalk']);
                        $isparity_name = ConfigModel::enum_isnot_text($v['isparity']);
                        $iscart_name = ConfigModel::enum_isnot_text($v['iscart']);
                        $iscollect_name = ConfigModel::enum_isnot_text($v['iscollect']);
                        $isfocus_name = ConfigModel::enum_isnot_text($v['isfocus']);
                        $isbrowseshop_name = ConfigModel::enum_isnot_text($v['isbrowseshop']);
                        $isbrowseinfo_name = ConfigModel::enum_isnot_text($v['isbrowseinfo']);
                        ?>
                        <div class="taskdetail">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">搜索关键词</label>
                            <div class="col-sm-3"><?php echo $v['searchkeywords']; ?></div>
                            <label class="col-sm-2 control-label form-label">下单实际价格</label>
                            <div class="col-sm-3"><?php echo $v['price']; ?>*<?php echo $v['num']; ?>单<?php if($v['priceremark']){ echo "(".$v['priceremark'].")";} ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">需要聊天</label>
                            <div class="col-sm-3"><?php echo $istalk_name; ?></div>
                            <label class="col-sm-2 control-label form-label">货比三家</label>
                            <div class="col-sm-3"><?php echo $isparity_name; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">加购物车</label>
                            <div class="col-sm-3"><?php echo $iscart_name; ?></div>
                            <label class="col-sm-2 control-label form-label">收藏宝贝</label>
                            <div class="col-sm-3"><?php echo $iscollect_name; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">关注店铺</label>
                            <div class="col-sm-3"><?php echo $isfocus_name; ?></div>
                            <label class="col-sm-2 control-label form-label">浏览店内两个宝贝以上</label>
                            <div class="col-sm-3"><?php echo $isbrowseshop_name; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">浏览详情到底5分钟以上</label>
                            <div class="col-sm-3"><?php echo $isbrowseinfo_name; ?></div>
                            <label class="col-sm-2 control-label form-label">其他要求</label>
                            <div class="col-sm-3"><?php echo $v['remark']; ?></div>
                        </div>
                            <?php if($find['istime']==2){?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">8点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time8']; ?></div>
                            <label class="col-sm-2 control-label form-label">9点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time9']; ?></div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label form-label">10点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time10']; ?></div>
                            <label class="col-sm-2 control-label form-label">11点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time11']; ?></div>
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label form-label">12点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time12']; ?></div>
                            <label class="col-sm-2 control-label form-label">13点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time13']; ?></div>
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label form-label">14点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time14']; ?></div>
                            <label class="col-sm-2 control-label form-label">15点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time15']; ?></div>
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label form-label">16点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time16']; ?></div>
                            <label class="col-sm-2 control-label form-label">17点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time17']; ?></div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label form-label">18点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time18']; ?></div>
                            <label class="col-sm-2 control-label form-label">19点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time19']; ?></div>
                        </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label form-label">20点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time20']; ?></div>
                            <label class="col-sm-2 control-label form-label">21点领取单数</label>
                            <div class="col-sm-3"><?php echo $v['time21']; ?></div>
                        </div>
                            <?php }?>

                        </div>
                        <?php }?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
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
<script type="text/javascript">
    
</script>

</body>
</html>