<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./application/merchant/view/task/edit.html";i:1586928865;s:64:"/www/wwwroot/nouser/application/merchant/view/common/header.html";i:1586928869;s:62:"/www/wwwroot/nouser/application/merchant/view/common/menu.html";i:1586928869;s:64:"/www/wwwroot/nouser/application/merchant/view/common/footer.html";i:1586928869;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo qtitle();?></title>
<link href="/css/root.css" rel="stylesheet">
    <style>
        input[type="checkbox"]{width:20px;height:20px;   margin-top: 5px!important;  border-radius: 20px;display: inline-block;text-align: center;vertical-align: middle; line-height: 18px;position: relative;}
        input[type="checkbox"]::before{content: "";position: absolute;top: 0;left: 0;background: #fff;width: 100%;height: 100%;border: 1px solid #d9d9d9}
        input[type="checkbox"]:checked::before{content: "\2713";background-color: #fff;position: absolute;top: 0;left: 0;width:100%;border: 1px solid #e50232;color:#e50232;font-size: 20px;font-weight: bold;}
        .paidan input[type="radio"]{width:20px;height:20px;   margin-top: 5px!important;  border-radius: 20px;display: inline-block;text-align: center;vertical-align: middle; line-height: 18px;position: relative;}
        .paidan input[type="radio"]::before{content: "";position: absolute;top: 0;left: 0;border-radius: 20px;background: #fff;width: 100%;height: 100%;border: 1px solid #d9d9d9}
        .paidan input[type="radio"]:checked::before{content: "\2713"; border-radius: 20px;background-color: #fff;position: absolute;top: 0;left: 0;border: 1px solid #e50232;color:#e50232;font-size: 20px;font-weight: bold;}
        input{
            box-shadow: none;
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
            <form action="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit.html" class="form-horizontal" method="post" id="dx_form" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="panel panel-default" style="padding-top:15px;">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">温馨提醒</label>
                            <div class="col-sm-8" style="padding-top:7px;color:red;">
                                <p>1、标签今日单任务，审核通过后是当天完成并下单的任务：建议在当天晚上8点前发布今日任务。</p>
                                <p>2、每天下午20：00后发布的任务默认为明天的任务。</p>
                                <p>3、请仔细核实宝贝主图、电脑端同手机端不是同一主图需上传手机端主图。</p>
                            </div>
                        </div>
                        <input type="hidden" name="task_id" value="<?php echo $parem['id']; ?>" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>*</b>订单类型</label>
                            <div class="col-sm-3" style="padding-top:7px;">
                                <?php foreach($enum_worktype_arr as $k=>$v){?>
                                <input type="radio" name="worktype" value="<?php echo $k; ?>" <?php if($k==1){ echo 'checked';}?> style="margin:0px;height:15px;" ><?php echo $v; }?>
                            </div>
                            <label class="col-sm-2 control-label form-label"><b>*</b>选择店铺</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="shop_id">
                                    <option value="">请选择</option>
                                    <?php foreach($shop_list as $k=>$v){?>
                                    <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$parem['shop_id']){ echo 'selected=selected';}?>  ><?php echo $v['name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-1" style="padding-top:7px;">
                                <a href="/home.php/merchant/shop/lists.html">添加店铺</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>*</b>权重类目号</label>
                            <div class="col-sm-3" data-toggle="tooltip" title="每个买家号通过日积月累的消费习惯和浏览习惯产生的高权重类目标签，此标签是淘宝系统分配的，我们的号通过查号接口已经得到用户权重类目并且已经分配好。">
                                <select class="form-control" name="cat">
                                    <?php foreach($enum_cat_arr as $k=>$v){?>
                                    <option value="<?php echo $k; ?>" <?php if($k==$parem['cat']){ echo 'selected=selected';}?> ><?php echo $v; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label form-label"><b>*</b>标签词</label>
                            <div class="col-sm-3" data-toggle="tooltip" title="标签词：一个产品的标示代表产品的身份的词句。它有时会是产品的品牌名，产品的成分，或者产品的独特个性！">
                                <input type="text" class="form-control" name="tags" value="<?php echo $parem['tags']; ?>" placeholder="必填" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>*</b>商品标题</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="goodstitle" value="<?php echo $parem['goodstitle']; ?>" placeholder="商品在淘宝全标题">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>*</b>商品链接</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="goodsurl" value="<?php echo $parem['goodsurl']; ?>" placeholder="需要补单商品链接，以http://或者https://开头">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>*</b>商品主图</label>
                            <div class="col-sm-8">
                                <input type="file" id="dx_file" name="dx_file" onchange="sc('mainimage');" style="display:none"/>
                                <img src="<?php echo $parem['mainimage']; ?>" id="imgView" style="height:100px;">
                                <input type="hidden" name="mainimage" value="<?php echo $parem['mainimage']; ?>"/>
                                <button type="button" class="btn btn-danger" onclick="dx_file.click()">点击上传</button>
                                <span style="color:red;">（建议尺寸800 X 800）</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">拍下规格</label>
                            <div style="width:25px;float:left;padding-left:15px;">
                                <input type="radio"  style="margin-top:0px;" name="isattr" <?php if($parem['isattr']==2){ echo 'checked';}?>  checked value="2">
                            </div>
                            <div class="col-sm-1" style="padding-top:7px;padding-left:8px;">任意规格</div>
                            <div style="width:25px;float:left;padding-left:15px;">
                                <input type="radio"  style="margin-top:0px;" name="isattr" <?php if($parem['isattr']==1){ echo 'checked';}?> value="1">
                            </div>
                            <div class="col-sm-2" style="padding-left:8px;">
                                <input type="text" class="form-control" name="attrcolor" disabled value="<?php echo $parem['attrcolor']; ?>" placeholder="填写颜色类型">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="attrsize" disabled value="<?php echo $parem['attrsize']; ?>" placeholder="填写尺码大小">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label"><b>*</b>付款方式</label>
                            <div class="col-sm-8" style="padding-top:7px;">
                                <p>
                                    是否允许用户花呗付款：
                                    <?php foreach($enum_ishuabei_arr as $k=>$v){?>
                                    <input type="radio" name="ishuabei" value="<?php echo $k; ?>" <?php if($k==$parem['ishuabei']){ echo 'checked';}?> style="margin:0px;height:15px;"><?php echo $v; }?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    是否允许用户信用卡付款：
                                    <?php foreach($enum_iscredit_arr as $k=>$v){?>
                                    <input type="radio" name="iscredit" value="<?php echo $k; ?>" <?php if($k==$parem['iscredit']){ echo 'checked';}?> style="margin:0px;height:15px;"><?php echo $v; }?>
                                </p>
                                <p>允许用户使用花呗和信用卡支付，会使下单付款更加真实<span style="color:red;">（产生的手续费由商家自行承担）</span></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">赠品</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="present" value="<?php echo $parem['present']; ?>" placeholder="建议赠送抽纸或卷纸">
                            </div>
                            <div class="col-sm-5" style="padding-top:7px;color:red;">（提示：禁止赠送有争议的产品，比如易碎、易破、产品质量超级垃圾等。）</div>
                        </div>
                        <div class="form-group paidan" >
                            <label class="col-sm-2 control-label form-label"><b>*</b>派单维度 </label>
                            <div class="col-sm-8" >
                                <p>
                                    <?php foreach($enum_istime_arr as $k=>$v){?>
                                    <input type="radio" name="istime"
                                           value="<?php echo $k; ?>" <?php if($k==$parem['istime']){ echo 'checked';}?>><?php echo $v; }?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group paidan"  >
                            <label class="col-sm-2 control-label form-label"><b>*</b>黑科技双标签</label>
                            <div class="col-sm-8">
                                <p>
                                    <?php foreach($enum_istag_arr as $k=>$v){?>
                                    <input type="radio" name="istag" value="<?php echo $k; ?>" <?php if($k==$parem['istag']){ echo 'checked';}?>><?php echo $v; }?>
                                </p>
                            </div>
                        </div>
                    <div class="form-group" id="istag" <?php if($parem['istag']==1) echo 'style="display: none;"'?>>
                        <label class="col-sm-2 control-label form-label">竞品宝贝关键词</label>
                        <div class="col-sm-1">
                            <input type="text" name="tagkeyworks" value="<?php echo $parem['tagkeyworks']; ?>" />
                        </div>
                        <label class="col-sm-2 control-label form-label">竞品宝贝链接</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="tagurl" value="<?php echo $parem['tagurl']; ?>" placeholder="" />
                        </div>

                    </div>
                        <?php foreach( $orderarr as $or=>$vr){?>
                        <div class="taskdetail" id="detail">
                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label"><span style="font-size: 16px;padding-right: 10px;" id="bianhao"><?php echo $or+1; ?>.</span><b>*</b>搜索关键词</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="searchkeywords[]" value="<?php echo $vr['searchkeywords'];?>">
                                </div>
                                <label class="col-sm-2 control-label form-label"><b>*</b>下单实际价格</label>
                                <div class="col-sm-1" data-toggle="tooltip" title="提示：下单金额需与淘宝最终购买价一致">
                                    <input type="text" class="form-control" rel="price" name="price[]" value="<?php echo $vr['price']?>">
                                </div>
                                <div class="col-sm-1" data-toggle="tooltip" title="备注：下单时需要注意的事项（比如领取优惠券等）">
                                    <input type="text" class="form-control" name="priceremark[]" value="<?php echo $vr['priceremark']?>" placeholder="备注">
                                </div>
                                <label class="col-sm-1 control-label form-label"><b>*</b>单数</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" rel="num" name="num[]" value="<?php echo $vr['num']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">需要聊天</label>
                                <div class="col-sm-1 ">
                                    <input type="checkbox" name="istalk[]" <?php if(2==$vr['istalk']){ echo 'checked';}?> value="2" style="margin-top:1px;">
                                </div>
                                <label class="col-sm-1 control-label form-label" style="padding-right:5px;">下单后回访店铺</label>
                                <div class="col-sm-1" style="padding-left:0px;">
                                    <input type="checkbox" name="isparity[]" <?php if(2==$vr['isparity']){ echo 'checked';}?> value="2" style="margin-top:1px;">
                                </div>
                                <label class="col-sm-1 control-label form-label" style="padding-right:5px;">收藏加购关注</label>
                                <div class="col-sm-1" style="padding-left:0px;">
                                    <input type="checkbox" name="iscart[]" value="2" style="margin-top:1px;" <?php if(2==$vr['isparity']){ echo 'checked';}?>>
                                </div>
                                <label class="col-sm-1 control-label form-label" style="padding-right:5px;">浏览猜你喜欢</label>
                                <div class="col-sm-1" style="padding-left:0px;">
                                    <input type="checkbox" name="iscollect[]" value="2" style="margin-top:1px;" <?php if(2==$vr['isparity']){ echo 'checked';}?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">深度浏览评价</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="isfocus[]" value="2" style="margin-top:1px;" <?php if(2==$vr['isparity']){ echo 'checked';}?>>
                                </div>
                                <label class="col-sm-2 control-label form-label" style="padding-right:5px;" >浏览店内两个宝贝以上</label>
                                <div class="col-sm-1" style="padding-left:0px;">
                                    <input type="checkbox" name="isbrowseshop[]" value="2" style="margin-top:1px;" <?php if(2==$vr['isbrowseshop']){ echo 'checked';}?>>
                                </div>
                                <label class="col-sm-2 control-label form-label" style="padding-right:5px;">深度浏览详情</label>
                                <div class="col-sm-1" style="padding-left:0px;">
                                    <input type="checkbox" name="isbrowseinfo[]" value="2" style="margin-top:1px;" <?php if(2==$vr['isbrowseinfo']){ echo 'checked';}?>>
                                </div>
                            </div>
                            <div id="istime" <?php if($parem['istime']==1) echo 'style="display: none;"'?>>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">8点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time8[]" value="<?php echo $vr['time8']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">9点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time9[]" value="<?php echo $vr['time9']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">10点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time10[]" value="<?php echo $vr['time10']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">11点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time11[]" value="<?php echo $vr['time11']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">12点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time12[]" value="<?php echo $vr['time12']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">13点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time13[]" value="<?php echo $vr['time13']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">14点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time14[]" value="<?php echo $vr['time14']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">15点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time15[]" value="<?php echo $vr['time15']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">16点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time16[]" value="<?php echo $vr['time16']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">17点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time17[]" value="<?php echo $vr['time17']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">18点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time18[]" value="<?php echo $vr['time18']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">19点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time19[]" value="<?php echo $vr['time19']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label form-label">20点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time20[]" value="<?php echo $vr['time20']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                    <label class="col-sm-2 control-label form-label">21点订单数</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="time21[]" value="<?php echo $vr['time21']; ?>" placeholder="不超过单数"
                                               rel="istimenum">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">其他要求</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="remark[]" value="<?php echo $vr['remark']; ?>" placeholder="备注">
                                    <div class="col-sm-9" id="keytishi" style="padding-top:7px;color:red;<?php if($parem['istime']==1) echo 'display: none';?>">提示：选择人工设置时间，必须每个关键词单数都要设置时间点，要不然会影响任务进行！！！</div>
                                </div>
                                <?php if($or>0){?>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger" rel="del" >删除</button>
                                </div> <?php }else{?>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger" rel="del" style="display:none;">删除</button>
                                </div>
                                <?php }?>
                            </div>
                            <div class="form-group" style="display:none;">
                                <label class="col-sm-2 control-label form-label">&nbsp;</label>
                                <div class="col-sm-8" style="color:red;">本金：1元，服务费：16元</div>
                            </div>
                        </div>
                        <?php }?>
                        <div id="more"></div>
                        <div class="form-group" id="lastDetail">
                            <div class="col-sm-offset-2 col-sm-3">
                                <button type="button" class="btn btn-success" id="addKeywords">添加关键词</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
                                <button type="button" class="btn btn-primary" id="sub">提交任务</button>
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
    var a=<?php echo count($orderarr) ;?>;
    var d=new Date() ;
    e=d.getHours();
    if(e<19) {
        for (i = 8; i < e; i++) {
            var time = "time" + i + "[]";
            $("#dx_form").find("input[name^='" + time + "']").attr('readOnly', 'true');
            $("#dx_form").find("input[name^='" + time + "']").val('0');
            $("#dx_form").find("input[name^='" + time + "']").attr('style', 'background-color:#eee');
        }
    }
    $("#addKeywords").on('click',function(){
        a++;
        var keywordsarr = '';
        var istime = $("[name='istime']:checked").val();
        if (istime==2) {
            keywordsarr = ' <div class="taskdetail" id="detail">' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label"><span style="font-size: 16px;padding-right: 10px;" id="bianhao">' + a + '.' + '</span><b>*</b>搜索关键词</label>' +
                    '<div class="col-sm-2">' +
                    '<input type="text" class="form-control" name="searchkeywords[]" value="">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label"><b>*</b>下单实际价格</label>' +
                    '<div class="col-sm-1" data-toggle="tooltip" title="提示：下单金额需与淘宝最终购买价一致">' +
                    '<input type="text" class="form-control" rel="price" name="price[]" value="">' +
                    '</div>' +
                    '<div class="col-sm-1" data-toggle="tooltip" title="备注：下单时需要注意的事项（比如领取优惠券等）">' +
                    '<input type="text" class="form-control" name="priceremark[]" value="" placeholder="备注">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label"><b>*</b>单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" class="form-control" rel="num" name="num[]" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label">需要聊天</label>' +
                    '<div class="col-sm-1 ">' +
                    '<input type="checkbox" name="istalk[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label" style="padding-right:5px;">下单后回访店铺</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="isparity[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label" style="padding-right:5px;">收藏加购关注</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="iscart[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label" style="padding-right:5px;">浏览猜你喜欢</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="iscollect[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label">深度浏览评价</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="checkbox" name="isfocus[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label" style="padding-right:5px;">浏览店内两个宝贝以上</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="isbrowseshop[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label" style="padding-right:5px;">深度浏览详情</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="isbrowseinfo[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '</div>' +
                    '<div>'+
                    '<div class="form-group"  >' +
                    '<label class="col-sm-2 control-label form-label">8点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time8[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">9点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time9[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div >'+
                    '<label class="col-sm-2 control-label form-label">10点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time10[]" value="0" placeholder="不超过单数" rel="istimenum">'+
                    '</div>' +
                    '</div>' +
                    '<div class="form-group"  >'+
                    '<label class="col-sm-2 control-label form-label">11点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time11[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">12点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time12[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">13点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time13[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group"  >' +
                    '<label class="col-sm-2 control-label form-label">14点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time14[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">15点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time15[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">16点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time16[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group"  >' +
                    '<label class="col-sm-2 control-label form-label">17点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time17[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">18点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time18[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">19点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time19[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group"  >' +
                    '<label class="col-sm-2 control-label form-label">20点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time20[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label">21点订单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" name="time21[]" value="0" placeholder="不超过单数" rel="istimenum">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label">其他要求</label>' +
                    '<div class="col-sm-7">' +
                    '<input type="text" class="form-control" name="remark[]" value="" placeholder="备注">' +
                    '<div class="col-sm-9" style="padding-top:7px;color:red;">提示：选择人工设置时间，必须每个关键词单数都要设置时间点，要不然会影响任务进行！！！</div>'+
                    '</div>' +
                    '<div class="col-sm-1">' +
                    '<button type="button" class="btn btn-danger" rel="del" style="display:none;">删除</button>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group" style="display:none;">' +
                    '<label class="col-sm-2 control-label form-label">&nbsp;</label>' +
                    '<div class="col-sm-8" style="color:red;">本金：1元，服务费：16元</div>' +
                    '</div>' +
                    '</div> ';
        } else {
            keywordsarr = ' <div class="taskdetail" id="detail">' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label"><span style="font-size: 16px;padding-right: 10px;" id="bianhao">' + a + '.' + '</span><b>*</b>搜索关键词</label>' +
                    '<div class="col-sm-2">' +
                    '<input type="text" class="form-control" name="searchkeywords[]" value="">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label"><b>*</b>下单实际价格</label>' +
                    '<div class="col-sm-1" data-toggle="tooltip" title="提示：下单金额需与淘宝最终购买价一致">' +
                    '<input type="text" class="form-control" rel="price" name="price[]" value="">' +
                    '</div>' +
                    '<div class="col-sm-1" data-toggle="tooltip" title="备注：下单时需要注意的事项（比如领取优惠券等）">' +
                    '<input type="text" class="form-control" name="priceremark[]" value="" placeholder="备注">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label"><b>*</b>单数</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="text" class="form-control" rel="num" name="num[]" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label">需要聊天</label>' +
                    '<div class="col-sm-1 ">' +
                    '<input type="checkbox" name="istalk[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label" style="padding-right:5px;">下单后回访店铺</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="isparity[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label" style="padding-right:5px;">收藏加购关注</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="iscart[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-1 control-label form-label" style="padding-right:5px;">浏览猜你喜欢</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="iscollect[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label">深度浏览评价</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="checkbox" name="isfocus[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label" style="padding-right:5px;">浏览店内两个宝贝以上</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="isbrowseshop[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '<label class="col-sm-2 control-label form-label" style="padding-right:5px;">深度浏览详情</label>' +
                    '<div class="col-sm-1" style="padding-left:0px;">' +
                    '<input type="checkbox" name="isbrowseinfo[]" value="2" style="margin-top:1px;">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="col-sm-2 control-label form-label">其他要求</label>' +
                    '<div class="col-sm-7">' +
                    '<input type="text" class="form-control" name="remark[]" value="" placeholder="备注">' +
                    '</div>' +
                    '<div class="col-sm-1">' +
                    '<button type="button" class="btn btn-danger" rel="del" style="display:none;">删除</button>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group" style="display:none;">' +
                    '<label class="col-sm-2 control-label form-label">&nbsp;</label>' +
                    '<div class="col-sm-8" style="color:red;">本金：1元，服务费：16元</div>' +
                    '</div>' +
                    '</div> ';
        }
//        $("#more").append($("#detail").clone());
        $("#more").append(keywordsarr);
        if(e<19) {
            for (i = 8; i < e; i++) {
                var time = "time" + i + "[]";
                $("#dx_form").find("input[name^='" + time + "']").attr('readOnly', 'true');
                $("#dx_form").find("input[name^='" + time + "']").val('0');
                $("#dx_form").find("input[name^='" + time + "']").attr('style', 'background-color:#eee');
            }
        }

        $("#more").find('button').show();
//        $("#more #detail").find('#bianhao').text(a+'.');
    });
    $("#dx_form").on('click','[rel=del]',function(){
        var b=$(this).parent().parent().parent().find('#bianhao').text();
        if(a+'.'!==b){
            $("#tipBtn").click();
            $("#tipText").html("请按倒序顺序删除！");
            return false;
        }else {
            $(this).parent().parent().parent().remove();
            a--;
        }
    });
    var isattr = $("[name='isattr']:checked").val();
    if(isattr==1){
        $("[name='attrcolor']").attr("disabled",false);
        $("[name='attrsize']").attr("disabled",false);
    }
    $("[name='isattr']").on('click',function(){
        var isattr = $("[name='isattr']:checked").val();
        if(isattr==2){
            $("[name='attrcolor']").attr("disabled",true);
            $("[name='attrsize']").attr("disabled",true);
        }else{
            $("[name='attrcolor']").attr("disabled",false);
            $("[name='attrsize']").attr("disabled",false);
        }
    });
    $("[name='istime']").on('click', function () {
        var istime = $("[name='istime']:checked").val();
        if (istime == 2) {
            $("#istime").show();
            $("#keytishi").show();
            $("#more").text('');
            a=1;
        }else{
            $("#istime").hide();
            $("#keytishi").hide();
            $("#more").text('');
            a=1;
        }
    });
    $("[name='istag']").on('click', function () {
        var istag = $("[name='istag']:checked").val();
        if (istag == 2) {
            $("#istag").show();
        }else{
            $("#istag").hide();
            $('[name=tagkeyworks]').val('');
            $('[name=tagurl]').val('');

        }
    });

    $("#dx_form").on('blur','[rel=price]',function(){
        var price = $(this).val();
        var num = $(this).parent().next().next().next().children().val();
        var thiss = $(this);
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_without.html',
            dataType:'text',
            data: "price="+price+"&num="+num,
            success:function(data)
            {
                var res = JSON.parse(data);
                if(res.code=='success'){
                    thiss.parent().parent().siblings().last().show();
                    var str = "本金："+res.money+"元，服务费："+res.without_money+"元";
                    thiss.parent().parent().siblings().last().children('.col-sm-8').html(str);
                }
            }
        });
    });
    $("#dx_form").on('blur','[rel=num]',function(){
        var num = $(this).val();
        var istime = $("[name='istime']:checked").val();
//        if (istime==2) {
//            if(num<14){
//                $("#tipBtn").click();
//                $("#tipText").html("单数最少为14单！");
//            }
//        }
        var price = $(this).parent().prev().prev().prev().children().val();
        var thiss = $(this);
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_without.html',
            dataType:'text',
            data: "price="+price+"&num="+num,
            success:function(data)
            {
                var res = JSON.parse(data);
                if(res.code=='success'){
                    thiss.parent().parent().siblings().last().show();
                    var str = "本金："+res.money+"元，服务费："+res.without_money+"元";
                    thiss.parent().parent().siblings().last().children('.col-sm-8').html(str);
                }
            }
        });
    });

    $("#sub").on('click',function(){
        var count_shop = "<?php echo count($shop_list);?>";
        var shop_id = $('[name=shop_id]').val();
        var tags = $('[name=tags]').val();
        var goodstitle = $('[name=goodstitle]').val();
        var goodsurl = $('[name=goodsurl]').val();
        var mainimage = $('[name=mainimage]').val();
        var sum=0;
        var istime = $("[name='istime']:checked").val();
        if(count_shop=='0'){
            $("#tipBtn").click();
            $("#tipText").html("请先添加店铺，再发布任务，或联系客服审核店铺！<a href='/home.php/merchant/shop/lists.html'>添加店铺</a>");
            return false;
        }
        if(shop_id==''){
            $("#tipBtn").click();
            $("#tipText").html("请选择店铺！");
            return false;
        }
        if(tags==''){
            $("#tipBtn").click();
            $("#tipText").html("请输入标签词！");
            return false;
        }
        if(goodstitle==''){
            $("#tipBtn").click();
            $("#tipText").html("请输入商品标题！");
            return false;
        }
        if(goodsurl==''){
            $("#tipBtn").click();
            $("#tipText").html("请输入商品链接！");
            return false;
        }
        if(mainimage==''){
            $("#tipBtn").click();
            $("#tipText").html("请上传商品主图！");
            return false;
        }
        if(istime==2) {
            for (i = 8; i < 22; i++) {
                var time = "time" + i + "[]";
                sum += $("#dx_form").find("input[name^='" + time + "']").val();
            }
            var numzh=$("#dx_form").find("input[name^='num[]']").val();
            if (sum <= 0) {
                $("#tipBtn").click();
                $("#tipText").html("时间段总数量不能小于0！");
                return false;
            }
        }
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_price_html.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='error'){
                    $("#tipBtn").click();
                    $("#tipText").html("时间段填入数量必须与填入单数相等");
                    return false;
                }else {
                    $("#confirmBtn").click();
                    $("#confirmText").html(data);
                }
            }
        });
    });

    $("#confirmSub").on('click',function(){
        var count_shop = "<?php echo count($shop_list);?>";
        var shop_id = $('[name=shop_id]').val();
        var tags = $('[name=tags]').val();
        var goodstitle = $('[name=goodstitle]').val();
        var goodsurl = $('[name=goodsurl]').val();
        var mainimage = $('[name=mainimage]').val();
        $('#confirmModal').hide();
        if(count_shop=='0'){
            $("#tipBtn").click();
            $("#tipText").html("请先添加店铺，再发布任务，或联系客服审核店铺！<a href='/home.php/merchant/shop/lists.html'>添加店铺</a>");
            return false;
        }
        if(shop_id==''){
            $("#tipBtn").click();
            $("#tipText").html("请选择店铺！");
            return false;
        }
        if(tags==''){
            $("#tipBtn").click();
            $("#tipText").html("请输入标签词！");
            return false;
        }
        if(goodstitle==''){
            $("#tipBtn").click();
            $("#tipText").html("请输入商品标题！");
            return false;
        }
        if(goodsurl==''){
            $("#tipBtn").click();
            $("#tipText").html("请输入商品链接！");
            return false;
        }
        if(mainimage==''){
            $("#tipBtn").click();
            $("#tipText").html("请上传商品主图！");
            return false;
        }
        $.ajax({
            type:'POST',
            cache:false,
            url:"/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_edit.html",
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    $("#confirmColse").click();$("#tipBtn").click();$("#tipText").html("操作成功");
                    setTimeout(function(){
                        window.history.back(-1);
                    },2000);
                }else{
                    $("#tipBtn").click();
                    if(data=='error'){
                        $("#tipText").html('余额不足，请充值！');
                        setTimeout(function () {
                            window.location.href="/home.php/merchant/merchantrecharge/lists.html";
                        }, 2000);
                    }else {
                        $("#tipText").html(data);
                        setTimeout(function () {
//                            window.location.reload();
                        }, 2000);
                    }


                }
            }
        });
    });
    $("#dx_form").on('blur', '[rel=istimenum]', function () {
        var reg=/^[0-9]+.?[0-9]*$/; //判断字符串是否为数字 ，判断正整数用/^[1-9]+[0-9]*]*$/
        var ss=$(this).val();
        if(!reg.test(ss)){
            $("#tipBtn").click();
            $("#tipText").html("请输入纯数字！");
            this.value = '0';
            return;
        }
//        if(ss < 1){
//            $("#tipBtn").click();
//            $("#tipText").html("最少1单，且不能超过单数！");
//            this.value = '1';
//            return;
//        }
        var inputs = $(this).parent().parent().parent().find("input");

        var val = 0;
        inputs.each(function () {
            val += +this.value;//值转换为number，然后相加
        });
        var a = $(this).parent().parent().parent().parent().find("input[name^='num[]']").val();
        if (val > a) {
            b=a-(val-ss);
            $("#tipBtn").click();
            $("#tipText").html("时间段订单总数不能超过单数,可以填"+b+"的数量！");
//            inputs.each(function () {
//                this.value = '0';//值转换为number，然后致空
//            });
            this.value =b;
        }
//        $(this).parent().parent().parent().parent().find("input[name^='num[]']").val(val)
//        if (val < a){
//            $("#tipBtn").click();
//            $("#tipText").html("时间段订单相加总数要等于单数");
//        }
    });
</script>

</body>
</html>