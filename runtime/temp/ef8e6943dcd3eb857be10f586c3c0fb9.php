<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:91:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\student\course_form.html";i:1561081471;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                <form class="layui-form layui-row" lay-filter="form-type" action="<?php echo url('courseEdit'); ?>">
                    <input type="hidden" name="id" />
                    <div class="layui-card-body" pad15>
                        <div class="layui-col-md4">
                            <div class="layui-form-item">
                                <label class="layui-form-label">课程名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="course" class="layui-input" lay-verify="required">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <a class="layui-btn" lay-submit="" lay-filter="layform">保存</a>
                                    <a href="<?php echo url('course'); ?>" class="layui-btn layui-btn-primary">返回</a>
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

