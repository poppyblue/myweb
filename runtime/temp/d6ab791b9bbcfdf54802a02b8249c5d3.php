<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\login\forget.html";i:1560325906;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo \think\Config::get('sys_name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <script src="/js/jquery-2.1.3.min.js"></script>
</head>
<body>
<div class="login">
    <div class="login-main">
        <div class="login-box login-header">
            <h2>忘记密码</h2>
        </div>
        <div class="login-box login-body layui-form">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="login-icon layui-icon layui-icon-file"></label>
                    <input type="text" name="email" lay-verify="email" placeholder="请输入邮箱"
                           class="layui-input">
                </div>
                <!--<div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="login-icon layui-icon layui-icon-vercode"></label>
                            <input type="text" name="vercode" lay-verify="required" placeholder="图形验证码"
                                   class="layui-input">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="padding-left: 10px;" class="captcha">
                                <img src="<?php echo captcha_src(); ?>" alt="captcha" id="captcha_img"
                                     onclick="this.src='<?php echo captcha_src(); ?>?seed='+Math.random()" class="login-codeimg">
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="login-icon layui-icon layui-icon-chat"></label>
                            <input type="text" name="emailCaptcha" lay-verify="required" placeholder="请输入邮箱码" class="layui-input">
                        </div>
                        <div class="layui-col-xs5" style="padding-left: 10px;">
                            <a class="layui-btn" id="sendCode">发送验证码</a>
                        </div>
                    </div>

                </div>

                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid layui-btn-disabled" disabled id="forget"  lay-submit="" lay-filter="forget">找回密码
                    </button>
                </div>
                <div class="layui-form-item" style="margin-bottom: 20px;">
                    <a href="index.html">返回登录</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/layui/layui.js"></script>
<script type="text/javascript">
    layui.config({
        base: '/js/'
    }).use('teach');
</script>

</body>
</html>
<script type="text/javascript">

    var InterValObj; //timer变量，控制时间
    var count = 120; //间隔函数，1秒执行
    var curCount;//当前剩余秒数
    $("#sendCode").click(function () {
        var $email = $('input[name=email]');
        var email = $.trim($email.val());
        var $vercode = $('input[name=vercode]');

        var vercode = $.trim($vercode.val());
        var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
        if (email == "") {
            layer.msg("请输入邮箱！", {icon: 2, time: 3000});
            $email.focus();
            return false;
        } else if (!reg.test(email)) { //正则验证不通过，格式不对
            layer.msg("请输入正确邮箱！", {icon: 2, time: 3000});
            $email.focus();
            return false;
        }
        if (vercode == "") {
            layer.msg("请输入图形验证码！", {icon: 2, time: 3000});
            $vercode.focus();
            return false;
        }

        $.ajax({
            url: "<?php echo url('login/checkCode'); ?>",
            method: 'post',
            dataType: "json",
            data: {vercode: vercode, email: email},
            beforeSend: function () {
                $("#sendCode").attr("disabled", true).css("pointer-events", "none").css({opacity: 0.2}).text("正在发送...");
            },
            success: function (res) {
                if (res.code > 0) {
                    layer.msg(res.msg);
                    $("#forget").removeAttr("disabled").removeClass('layui-btn-disabled');
                    curCount = count;
                    //设置效果，开始计时
                    $("#sendCode").text(curCount + "秒");
                    InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                } else {
                    $("#sendCode").attr("disabled", false).css("pointer-events", "auto").css({opacity: 1});
                    $("#sendCode").text("发送验证码");
                    $("#captcha_img").click();
                    layer.msg(res.msg, {icon: 2, time: 3000});
                }
            }
        })
    });

    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#sendCode").attr("disabled", false).css("pointer-events", "auto").css({opacity: 1});
            $("#captcha_img").click();
            $("#sendCode").text("点击重新获取");

        } else {
            curCount--;
            $("#sendCode").text(curCount + "秒");
        }
    }

    layui.use(['layer', 'form'], function () {
        var layer = layui.layer, $ = layui.jquery, form = layui.form;
        form.on('submit(forget)', function (data) {
            $.ajax({
                url: "<?php echo url('admin/login/forget'); ?>",
                data: data.field,
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    $("#forget").attr("disabled", "disabled").addClass('layui-btn-disabled').text('正在验证...');
                },
                success: function (res) {
                    if (res.code == 1) {
                        layer.msg('验证成功,正在跳转...', {
                            icon: 1, time: 1000 //1秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            location.href = res.url;
                        });
                    } else {
                        $("#forget").removeAttr("disabled").removeClass('layui-btn-disabled').text('找回密码');
                        $('.captcha img').attr('src', '<?php echo captcha_src(); ?>?id=' + Math.random());
                        layer.msg(res.msg, {icon: 2});
                    }
                }
            });
            return false;
        });
    });
</script>
