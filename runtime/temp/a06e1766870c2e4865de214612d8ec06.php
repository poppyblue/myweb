<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\user\pwd_reset.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
    <link rel="stylesheet" href="/css/admin.css" media="all" />
    <link rel="stylesheet" href="/css/font-awesome.css">
    <script src="/js/jquery-2.1.3.min.js"></script>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <form class="layui-form layui-row" action="<?php echo url('pwdReset'); ?>">
                    <div class="layui-card-body" pad15>
                        <div class="layui-col-md4">
                            <div class="layui-form-item">
                                <label class="layui-form-label">当前密码</label>
                                <div class="layui-input-block">
                                    <input type="password" name="oldPassword"  lay-verify="required"   class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">新密码</label>
                                <div class="layui-input-block">
                                    <input type="password" name="pwd" lay-verify="pass"   autocomplete="off" id="pwd" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">确认新密码</label>
                                <div class="layui-input-block">
                                    <input type="password"   lay-verify="repass"  autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <a class="layui-btn" lay-submit="" lay-filter="layform">确认修改</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
<script>
    layui.use('form', function () {
        var form = layui.form, $ = layui.jquery;
        form.verify({
            pass: [/(.+){1,12}$/, '密码必须1到12位'],
            repass: function (value) {
                var repassvalue = $('#pwd').val();
                if (value != repassvalue) {
                    return '两次输入的密码不一致!';
                }
            }
        })
    });
</script>