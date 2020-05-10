<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./application/merchant/view/merchant/findpass.html";i:1586928868;}*/ ?>
<!DOCTYPE HTML>
<html lang="zxx">
<head>
    <title><?php echo qtitle();?></title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content=""/>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="/css/sj/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <link rel="stylesheet" href="/css/sj/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->
</head>

<body>
<!-- bg effect -->
<div id="bg">
    <canvas></canvas>
    <canvas></canvas>
    <canvas></canvas>
</div>
<!-- //bg effect -->
<!-- title -->
<h1>平台名称</h1>
<!-- //title -->
<!-- content -->
<div class="sub-main-w3">
    <form action="" name="" autocomplete="off" id="dx_form">
        <h2>Retrieve password Now
            <i class="fas fa-level-down-alt"></i>
        </h2>
        <div class="form-style-agile">
            <label>
                <i class="fas fa-user"></i>
                用户名
            </label>
            <input name="mobile" placeholder="请输入手机号码" type="text" class="input-text" required="">
        </div>
        <div class="form-style-agile">
            <label style="width:100%;">
                <i class="fas fa-user"></i>
                短信验证
            </label>
            <input name="smscode" placeholder="请输入短信验证码" type="text" style="width: 60%;">
            <input type="button" style="padding: 15px 0; margin-top: 0" value="获取验证码" class="send-button js-send-phone-code" id="send">
            <input type="button"  value="发送中..." class="send-button js-send-phone-code" id="send2" style="display:none;padding: 15px 0;margin-top: 0">
            <span class="error-mes show-after-input"></span>
        </div>
        <div class="form-style-agile">
            <label>
                <i class="fas fa-unlock-alt"></i>
                密码
            </label>
            <input type="password" name="password" placeholder="密码" required="">
        </div>
        <div class="form-style-agile">
            <label>
                <i class="fas fa-unlock-alt"></i>
                确认密码
            </label>
            <input type="password" name="comfirm_password" placeholder="确认密码" required="">
        </div>
        <!-- checkbox -->
        <div class="wthree-text">
            <ul>
                <li style="font-size: 18px;">
                    <a href="/home.php/<?php echo $module; ?>/<?php echo $control; ?>/login.html">已找回密码！立即登录 </a>
                </li>
            </ul>
        </div>
        <!-- //checkbox -->
        <input type="button" value="找回密码" id="sub">
    </form>
</div>
<!-- //content -->

<!-- copyright -->
<div class="footer">
    <!--<p>Copyright © 2015 - 2019 猫客网络 <a href="http://www.miibeian.gov.cn/" target="_blank"> 粤ICP备15008861号</a></p>-->
</div>
<!-- //copyright -->

<!-- Jquery -->
<script src="/js/jquery-1.9.1.min.js"></script>
<!-- //Jquery -->

<!-- effect js -->
<script src="/js/sj/canva_moving_effect.js"></script>
<!-- //effect js -->
<script src="/js/jquery.cookie.js"></script>
<script type="text/javascript">
    function isMobile(value){
        if(/^13\d{9}$/g.test(value)||(/^14[0-35-9]\d{8}$/g.test(value))||(/^15[0-35-9]\d{8}$/g.test(value))||(/^16[0-35-9]\d{8}$/g.test(value))||(/^17[0-35-9]\d{8}$/g.test(value))||(/^18[01-9]\d{8}$/g.test(value))||(/^19[01-9]\d{8}$/g.test(value))){
            return true;
        }else{
            return false;
        }
    }
    function timedown(time){
        $("#send").hide();
        $("#send2").show();
        $("#send2").attr('value',time+"秒");
        time = time-1;
        if(time>=0)
        {
            setTimeout("timedown("+time+")",1000);
        }else
        {
            $("#send2").hide();
            $("#send").show();
        }
    }
    $("#send").on('click',function(){
        var mobile = $("[name=mobile]").val();
        if(mobile==''){
            alert('请输入手机号');return false;
        }
        if(isMobile(mobile) == false){
            alert('请输入正确的手机号');return false;
        }
        $("#send").hide();
        $("#send2").show();
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_send_findpass.html',
            dataType:'text',
            data:"mobile="+mobile,
            success:function(data)
            {
                if(data=='success'){
                    timedown(60);
                }else{
                    alert(data);
                    $("#send2").hide();
                    $("#send").show();
                }
            }
        });
    });

    $("#sub").bind('click',function(){
        var mobile = $("[name='mobile']").val();
        var smscode = $("[name='smscode']").val();
        var password = $("[name=password]").val();
        var password_length = parseInt($("[name=password]").val().length);
        var comfirm_password = $("[name=comfirm_password]").val();
        if(mobile==''){
            alert('请输入手机号');return false;
        }
        if(smscode==''){
            alert('请输入短信验证码');return false;
        }
        if(password==''){
            alert('请输入密码，密码长度6-16位');return false;
        }
        if(password_length<6 || password_length>16){
            alert('请输入密码，密码长度6-16位');return false;
        }
        if(password!=comfirm_password){
            alert('请确认密码');return false;
        }
        $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/<?php echo $module; ?>/<?php echo $control; ?>/act_findpass.html',
            dataType:'text',
            data:$("#dx_form").serialize(),
            success:function(data)
            {
                if(data=='success'){
                    alert("找回密码成功，立即登录");
                    window.location.href='/home.php/<?php echo $module; ?>/<?php echo $control; ?>/login.html';
                }else{
                    alert(data);
                }
            }
        })
    });
</script>

</body>

</html>