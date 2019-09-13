<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\system\config.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                <form class="layui-form layui-row" action="<?php echo url('config'); ?>">
                    <div class="layui-card-body" pad15>
                        <div class="layui-col-md4">
                            <div class="layui-tab layui-tab-brief" lay-filter="setting">
                                <ul class="layui-tab-title">
                                    <li lay-id="web" class="layui-this">网站设置</li>
                                    <li lay-id="email">邮件设置</li>
                                </ul>
                                <div class="layui-tab-content">
                                    <div class="layui-tab-item layui-show">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">网站名称</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="web_name" class="layui-input"
                                                       value="<?php echo config('web.web_name'); ?>" lay-verify="required">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">网站描述</label>
                                            <div class="layui-input-block">
                                                <textarea name="web_desc" class="layui-textarea"><?php echo config('web.web_desc'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="layui-tab-item">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">服务器</label>
                                            <div class="layui-input-block">
                                                <input type="text" lay-verify="required" name="smtp_server"
                                                       value="<?php echo config('web.smtp_server'); ?>" placeholder="SMTP服务器"
                                                       class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">SMTP端口</label>
                                            <div class="layui-input-block">
                                                <input type="text" lay-verify="required" name="smtp_port"
                                                       value="<?php echo config('web.smtp_port'); ?>" placeholder="SMTP端口" value=""
                                                       class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">发件人</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="smtp_id" value="<?php echo config('web.smtp_id'); ?>"
                                                       lay-verify="required" placeholder="发信人" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">发件邮箱</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="smtp_user" value="<?php echo config('web.smtp_user'); ?>"
                                                       lay-verify="required" placeholder="发信人邮件地址" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">身份验证码</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="smtp_pwd" value="<?php echo config('web.smtp_pwd'); ?>"
                                                       lay-verify="required" placeholder="SMTP身份验证码"
                                                       class="layui-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-input-block">
                                            <a class="layui-btn" lay-submit="" lay-filter="layform">保存</a>
                                        </div>
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
<script src="/layui/layui.js"></script>
<script type="text/javascript">
    layui.config({
        base: '/js/'
    }).use('teach');
</script>

</body>
</html>

