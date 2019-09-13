<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\login\reg.html";i:1560325906;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
            <h2>用户注册</h2>
        </div>
        <div class="login-box login-body layui-form">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="login-icon layui-icon layui-icon-username"></label>
                    <input type="text" name="username" autocomplete="false"  lay-verify="required"
                           placeholder="用户名"   class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="login-icon layui-icon layui-icon-password"></label>
                    <input type="password" name="pwd" lay-verify="required"  placeholder="密码"
                           class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="login-icon layui-icon layui-icon-file"></label>
                    <input type="text" name="email" lay-verify="email"  placeholder="邮箱，用于找回密码"
                           class="layui-input">
                </div>
                <!--<div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="login-icon layui-icon layui-icon-vercode"></label>
                            <input type="text" name="vercode" lay-verify="required"  placeholder="图形验证码"
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
                    <button class="layui-btn layui-btn-fluid layui-btn-danger" id="reg" lay-submit="" lay-filter="reg">注册</button>
                </div>
                <div class="layui-form-item" style="margin-bottom: 20px;">
                    <a href="index.html">已有账号，去登录</a>
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
    layui.use(['layer', 'form'], function () {
        var layer = layui.layer, $ = layui.jquery, form = layui.form;
        form.on('submit(reg)', function (data) {
            $.ajax({
                url: "<?php echo url('admin/login/reg'); ?>",
                data: data.field,
                dataType: 'json',
                type: 'post',
                beforeSend: function () {
                    $("#reg").attr("disabled", "disabled").addClass('layui-btn-disabled').text('正在注册...');
                },
                success: function (res) {
                    if (res.code == 1) {
                        layer.msg('注册成功,正在跳转...', {
                            icon: 1, time: 1000 //1秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            location.href = res.url;
                        });
                    } else {
                        $("#reg").removeAttr("disabled").removeClass('layui-btn-disabled').text('注册');
                        $('.captcha img').attr('src', '<?php echo captcha_src(); ?>?id=' + Math.random());
                        layer.msg(res.msg, {icon:2});
                    }
                }
            })
            return false;
        });
    });
</script>
