<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./application/merchant/view/merchant/register.html";i:1588042918;}*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="keywords" content="网商8861">
    <meta name="description" content="www.8861.com">
    <title>网商8861_www.8861.com</title>

    <!--[if lt IE 9]>
    <script src="//statics/newcommon/js/html5shiv.js"></script>
    <![endif]-->
    <link  rel="Shortcut  Icon"  href="/statics/home/images/minilogo.png">
    <link rel="stylesheet" href="/statics/newcommon/css/m2-commonNew.css?20160520">
    <link rel="stylesheet" href="/statics/home2/css/m2-main.css?20160520">
    <link rel="stylesheet" href="/statics/newcommon/css/m2-common.css?20160520">
    <script type="text/javascript" src="/statics/home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/statics/newcommon/js/common.js?20160520"></script>

    <title>注册--网商8861</title>
    <link rel="stylesheet" href="/statics/home2/css/login.css">
    <link rel="stylesheet" href="/statics/home2/css/userCenter.css">
    <link rel="stylesheet" href="/statics/home2/css/m2-main.css?20160520">
    <div class="m2-loginBg" style="display:none;"></div>
    <div class="m2-login-voice" style="display:none;">
        <i class="m2-loginVoi-boxClose"></i>
        <div class="m2-logVoi-psg">您的注册手机号</div>
        <div class="m2-logVoi-btn">
            <span class="m2-logVoi-sur">确&nbsp;&nbsp;&nbsp;定</span>
            <span class="m2-logVoi-can">取&nbsp;&nbsp;&nbsp;消</span>
        </div>
    </div>
    <div class="m2-loginReg-box" style="display:none;">
        <i class="m2-loginReg-boxClose"></i>
       
        </div>
    </div>
    <!--公共提示框start-->
    <div class="m2-pwdBg" style='display:none;z-index:9000'></div>
    <div class="m2-pwdConfirm" style='display:none;z-index:9001'>
        <i class="m2-pwdConfirm-close"></i>
        <i class="m2-pwdConfirm-ture" id='dialog-status'></i>
        <div class="m2-pwdConfirm-con">

        </div>
    </div>
    <style type="text/css">
        .myloginmask {position:fixed;top: 0;left: 0;right: 0;bottom: 0;background-color: black;display: none;opacity: 0.7;z-index: 800;filter:alpha(opacity=70)}
        .mylogin {position:   fixed;top: 50%;left: 50%;margin-top: -346px;margin-left: -260px;width: 520px;height: 496px;background-image: url("/statics/home2/images/login/login_info.png");background-repeat: no-repeat;z-index: 1000;display: none;}
        .mylogin .topcontent {font-weight:bold;text-align: center;color: #666666;font-size: 18px;padding-top: 284px;line-height: 36px;}
        .mylogin .topcontent span {color: #883535;}
        .mylogin .bottomcontent {font-weight:bold;font-size:20px;line-height: 30px;width:384px;margin: 50px auto;}
        .mylogin .bottomcontent a{color: #333333;text-decoration: none;}
        .mylogin .closeimg {position: absolute;top: 220px;right: 14px;width: 43px;height: 43px;background-image: url("/statics/home2/images/login/cha.png");}
    </style>
    <div class="myloginmask"></div>
    <div class="mylogin">
        <div class="closeimg"></div>
        <div class="topcontent">
            <p><span id="user"></span>，欢迎回来！</p>
            <p>网商8861<span id="nowcoin"></span>个，<span id="mytime"></span>即将到期<span id="overcoin"></span>个</p>
        </div>
        <div class="bottomcontent">
            <a href="#"> 查看规则>></a>
            <a href="#" style="float:right">钱帮币兑换宝物>></a>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('.m2-pwdConfirm-auto b').click(function(){
                $('.m2-pwdConfirm-auto,.m2-pwdBg').hide();
            })
        })
    </script>
    <script type="text/javascript">
        $(function(){
            $.post("mydatetime.html",{mytime:''},function(t){
                $("#mytime").html(t);
            });
        })
    </script>
    <script type="text/javascript">
        function infoDialogClose(){
            $('.m2-pwdConfirm-close').click(function(){
                $('.m2-pwdBg').hide();
                $('.m2-pwdConfirm').hide();
                $('.m2-pwdConfirm-con').text('');
                $('#dialog-status').removeClass('m2-pwdConfirm-ture');
                $('#dialog-status').removeClass('m2-pwdConfirm-false');
                $(this).unbind();
            });
        }
        function showInfoDialog(text,status,func,callback){
            $('.m2-pwdConfirm-con').text(text);
            if(status){
                $('#dialog-status').addClass('m2-pwdConfirm-ture');
            }else{
                $('#dialog-status').addClass('m2-pwdConfirm-false');
            }
            $('.m2-pwdBg').show();
            $('.m2-pwdConfirm').show();
            if(typeof(callback)=='function'){
                $('.m2-pwdConfirm-close').click(callback);
            }
            infoDialogClose();
            if(typeof(func)=='function'){
                func();
            }
//          $(".mylogin").show();
        }
        function showLoginInfoDialog(text,status,func,callback){
            $('.m2-pwdConfirm-con').text(text);
            if(status){
                $('#dialog-status').addClass('m2-pwdConfirm-ture');
            }else{
                $('#dialog-status').addClass('m2-pwdConfirm-false');
            }
            $('.m2-pwdBg').show();
            $('.m2-pwdConfirm').show();
            if(status){
                $('.m2-pwdConfirm').hide();
                $('.m2-pwdConfirm-auto').show();
            }
            if(typeof(callback)=='function'){
                $('.m2-pwdConfirm-close').click(callback);
            }
            infoDialogClose();
            if(typeof(func)=='function'){
                func();
            }
        }
        function showLoginDialog(text,status){
            $("#nowcoin").html(text.allcoin);
            $("#overcoin").html(text.overcoin);
            $("#user").html(text.userName);
            $(".mylogin").show();
            $(".myloginmask").show();
        }
        $(".mylogin .closeimg").click(function(){
            $(".mylogin").hide();
            $(".myloginmask").hide();
            window.location.href="/Index";
        })
    </script>
    <!--公共提示框end-->
    <div class="m2-regist-main">
        <div class="m2-regist-center">
            <div class="m2-regist-logo" style="height:46px">
                <a href='/'><img src="/statics/home2/images/new-logo.png"></a>
            </div>
            <div class="m2-regist-left">
                <ul>
                    <li><i class="m2-regist-step"></i>注册</li>
                </ul>
                <div class="m2-regist-inputarea">
                    <h4><b>会员注册</b>已有网商8861账号？<a href="/home.php/merchant/merchant/login.html">登录</a></h4>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td><i class="m2-regist-mobicon"></i>手机号</td>
                            <td class="m2-regist-tdInput"><input type="text" maxlength="11" class="m2-regist-username" maxlength="11" placeholder="请输入常用手机号" id="phone" /><span class="m2-regist-errMsg"></span></td>
                        </tr>
                         <tr style="display:">
                            <td><i class="m2-regist-passicon"></i>手机验证码</td>
                            <td class="m2-regist-tdInput m2-regist-check">
                                <span class="m2-regTeltips m2-regTel-step1">
                                    <span class="m2-logVoi-sur" style="width:100%">获取手机验证码</span>
                                </span>
                                <input type="text" class="m2-regist-username m2-regist-code" placeholder="验证码" id="phonecode" maxlength="6"  style="width:131px;" />
                                <span class="m2-regist-errMsg"></span>
                            </td>
                        </tr>

                        <tr>
                            <td><i class="m2-regist-passicon"></i>密码</td>
                            <td class="m2-regist-tdInput"><input type="password" class="m2-regist-username" maxlength="15" placeholder="6-15位常用英文字母或数字" id="password" /><span class="m2-regist-errMsg"></span></td>
                        </tr>
                       <tr>
                            <td><i class="m2-regist-passicon"></i>确认密码</td>
                            <td class="m2-regist-tdInput"><input type="password" class="m2-regist-username" maxlength="15" placeholder="6-15位常用英文字母或数字" id="repasswd" /><span class="m2-regist-errMsg"></span></td>
                        </tr>
                         <tr>
                            <td><i class="m2-regist-passicon"></i>微信号</td>
                            <td class="m2-regist-tdInput"><input type="text" class="m2-regist-username" maxlength="15" placeholder="" id="weixin" /><span class="m2-regist-errMsg"></span></td>
                        </tr>
                            <tr>
                            <td><i class="m2-regist-passicon"></i>负责导师</td>
                            <td class="m2-regist-tdInput"> <select class="m2-regist-username" name="aid" id="aid">
                <option value="0">请选择</option>
                <?php foreach($teacher_list as $v){?>
                <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                <?php }?>
            </select></td>
                        </tr>


                    </table>
                    <div class="m2-regist-btn">
                       <input type="checkbox" checked="checked" id="service" />我同意 <!--<b>《网商8861注册协议》</b> --><a href="javascript:void(0)" onClick="register();">提交注册</a>
                    </div>

                </div>
                <p>为了您的数据安全，我们采用了SSL传输方式，256位SGC加密保护!</p>
            </div>
            <div class="m2-login-right">
                <h2>注册有礼</h2>
                <p>首次浏览，<br/>了解更多细节请进<a href="guide.html" target="_blank">新手引导>></a></p>
            </div>
        </div>
    </div>
    <!--新用户完成注册-->
    <div class="comregist" id="newregister" style="display:none;">
        <div class="comregistmask z100"></div>
        <div class="comregistbox z101">
            <div class="comregistbox_b">
                <p></p>
                <div>
                    <img src="/statics/home2/images/december-expermoney/regist.png">
                    <span class="incentivebox_bp1">恭喜您注册网商8861，<span class="red">20000元</span>体验金已经发送您的账户</span>
                    <p class="comregistbox_bp2">您可以去体验金项目进行投资</p>
                </div>
                <a href="tiyanjin.html">去投资</a>
                <div class="close" id="newregister-close"><img src="/statics/home2/images/december-expermoney/close.png"></div>
            </div>
        </div>
    </div>
    <!--新用户完成注册-->
    <input type="hidden" value="1" id="regvalue">
    <input type="hidden" name='sourcelist' id="from" value="0"/>
    <script type="text/javascript">
        $(function(){
            //显示弹窗

            $('.m2-regist-btn b').click(function(){
                $('.m2-loginBg').show();
                $('.m2-loginReg-box').show();
            });

            //隐藏弹窗(体验金弹框)
            $("#newregister-close").click(function(){
                $("#newregister").hide();
            });
            //隐藏弹窗
            $(".m2-loginReg-boxClose").click(function(){
                $('.m2-loginBg').hide();
                $('.m2-loginReg-box').hide();
            });

            //隐藏弹窗
            $(".m2-loginReg-boxClose").click(function(){
                $('.m2-loginBg').hide();
                $('.m2-loginReg-box').hide();
            });
            $('.m2-logVoi-sur,.m2-logVoi-can,.m2-loginVoi-boxClose').click(function(){
                $('.m2-loginBg').hide();
                $('.m2-login-voice').hide();
            })
            //弹出框高度
            var winHeight=$(window).height();
            $('.m2-loginReg-box').css('top',(winHeight-510)/2);
            $('.m2-reg-voice').click(function(){
                if($('#phone').val()==''){
                    $('#phone').next('.m2-regist-errMsg').html('手机号不能为空！');
                    return false;
                }
                if($('#vcode').val()==''){
                    $('#vcode').next('.m2-regist-errMsg').html('验证码不能为空！');
                    return false;
                }
                if($('.m2-reg-voice').hasClass('m2-reg-voice-able')){
                    $('.m2-loginBg').show();
                    $('.m2-login-voice').show();
                }
            });

            $('.m2-logVoi-sur').click(function(){
                var p={};
                p['phone']=$('#phone').val();
                if($('#phone').val()==''){
                    $('#phone').next('.m2-regist-errMsg').html('手机号不能为空！');
                    return false;
                }
                  $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/merchant/merchant/act_send_register',
            dataType:'text',
            data:p,
            success:function(data)
            {
                if(data=='success'){
                    alert("验证码发送成功");
                }else{
                    alert(data);
                }
            }
           })
               

            });
        });
    </script>
    <script type="text/javascript">
        var next_url="/home-register-openbankid.shtml";
        function checkpsw(){
            if($('#password').val()==''){
                $('#password').next('.m2-regist-errMsg').html('密码不能为空！');
                return false;
            }

            if($('#password').val().length<6){
                $('#password').next('.m2-regist-errMsg').html('密码不能少于6个字符！');
                return false;
            }
            if($('#password').val().length>15){
                $('#password').next('.m2-regist-errMsg').html('密码不能超过15个字符！');
                return false;
            }
            var reg = /^[a-zA-Z0-9]*$/g;
            if(!reg.test($('#password').val())){
                $('#password').next('.m2-regist-errMsg').html('密码格式错误');
                return false;
            }
            $('#password').next('.m2-regist-errMsg').html('');
        }
        function recheckpsw(){
            if($('#repasswd').val()==''){
                $('#repasswd').next('.m2-regist-errMsg').html('确认密码不能为空！');
                return false;
            }
            if($('#password').val()!=$('#repasswd').val()){
                $('#repasswd').next('.m2-regist-errMsg').html('两次输入的密码不一致！');
                return false;
            }
            $('#repasswd').next('.m2-regist-errMsg').html('');
        }



        function register(){
            checkpsw();
            recheckpsw();
            //checkuser();
            if($('#phone').val()==''){
                $('#phone').next('.m2-regist-errMsg').html('手机号不能为空！');
                return false;
            }
            var reg=/^(13|14|15|17|18)[0-9]{9}$/;
                if(!reg.test($('#phone').val())){
                    $('#phone').next('.m2-regist-errMsg').html('手机号格式错误！');
                    return false;
            }
            var canSubmit = true;
            var p = makevar(['phone','password','phonecode','repasswd','weixin','aid']);

            p['mobile']  = $('#phone').val();

            var options=$("#aid option:selected")
            if(options.val() <= 0 || options.val()==''){
                showInfoDialog("选择一位导师,迅速推广自己的店铺",0);
                canSubmit = false;
            }
            p['aid']=options.val();
            

            if(($('#phonecode').val()=='')||($('#pass_word').val()=='')||($('#phone').val()=='')){
                canSubmit = false;
            }
            p['smscode'] = $('#phonecode').val();

            $(".m2-regist-errMsg").each(function(){
                if($(this).html().length>0){
                    canSubmit = false;
                }
            });
            if(!$("#service").is(":checked")){
                showInfoDialog("必须先同意服务协议!",0);
                canSubmit = false;
            }
            if(canSubmit!==true) return false;

            $.ajax({
            type:'POST',
            cache:false,
            url:'/home.php/merchant/merchant/act_register.html',
            dataType:'text',
            data:p,
            success:function(data)
            {
                if(data=='success'){
                    alert("注册成功");
                    window.location.href='/home.php/merchant/merchant/login.html';
                }else{
                    alert(data);
                }
            }
           })
            
        }



        $(document).keydown(function(e){
            if(e.keyCode == 13) {
                register();
            }
        });



    </script>
    <script type="text/javascript">
        //倒计时
        var tim =60; //剩余时间
        function tim_Down(){
            if (tim>0) {
                $('.m2-regTel-sec').show().html(tim);
                tim--;
                setTimeout("tim_Down()", 1000);
            }
            else if (tim<=0) {
                $('.m2-regTel-sec').hide();
                $('.m2-regTel-det').html('重新获取');
                $('.m2-regTeltips').addClass('m2-regTel-step1').removeClass('m2-regTel-step2');
                $('.m2-reg-voice').addClass('m2-reg-voice-able').removeClass('m2-reg-voice-unable');
                tim=60;
            }
        }
    </script>
    </body>
</html>