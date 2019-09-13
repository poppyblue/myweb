<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\login\index.html";i:1560325906;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo config('web.sys_name'); ?></title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
<div class="login" id="LAY-user-login">

    <div class="login-main">
        <div class="login-box login-header">
            <h2>用户登录</h2>
        </div>
        <div class="login-box login-body layui-form">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="login-icon layui-icon layui-icon-username"></label>
                    <input type="text" name="username" autocomplete="false" value="1" lay-verify="required"
                           placeholder="用户名"   class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="login-icon layui-icon layui-icon-password"></label>
                    <input type="password" name="password" lay-verify="required" value="1" placeholder="密码"
                           class="layui-input">
                </div>
                <!--<div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="login-icon layui-icon layui-icon-vercode"></label>
                            <input type="text" name="vercode" lay-verify="required" value="1" placeholder="图形验证码"
                                   class="layui-input">
                        </div>
                        <div class="layui-col-xs5">
                            <div style="padding-left: 10px;" class="captcha">
                                <img src="<?php echo captcha_src(); ?>" alt="captcha"
                                     onclick="this.src='<?php echo captcha_src(); ?>?seed='+Math.random()" class="login-codeimg">
                            </div>
                        </div>
                    </div>
                </div>-->

                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid" id="login" lay-submit="" lay-filter="login">立即登录</button>
                </div>
                <div class="layui-form-item" style="margin-bottom: 20px;">
                    <a href="<?php echo url('login/reg'); ?>">注册帐号</a>
                    <a href="<?php echo url('login/forget'); ?>" class="jump-change">忘记密码？</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['layer', 'form'], function () {
        var layer = layui.layer, $ = layui.jquery,$ = layui.jquery, form = layui.form;
        form.on('submit(login)', function (data) {
            $.ajax({
                url: "<?php echo url('admin/login/index'); ?>",
                data: data.field,
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    $("#login").attr("disabled", "disabled").addClass('layui-btn-disabled').text('正在登录...');
                },
                success: function (res) {
                    if (res.code == 1) {
                        layer.msg('登录成功,正在跳转...', {
                            icon: 1, time: 1000 //1秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            location.href = res.url;
                        });
                    } else {
                        $("#login").removeAttr("disabled").removeClass('layui-btn-disabled').text('立即登录');
                        $('.captcha img').attr('src', '<?php echo captcha_src(); ?>?id=' + Math.random());
                        layer.msg(res.msg, {icon:2});
                    }
                }
            })
            return false;
        });
    });
</script>
</body>

</html>