<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\auth\form.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
    <div class="layui-row ">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body" pad15>
                    <form class="layui-form layui-row" method="post" lay-filter="form-rule" action="<?php echo url('edit'); ?>" id="form-rule">
                        <input type="hidden" class="field-id" name="id" />
                        <div class="layui-form-item">
                            <label class="layui-form-label">所属菜单</label>
                            <div class="layui-input-2">
                                <select name="pid" class="field-pid" type="select" lay-filter="pid">
                                    <option value="0" level="0">顶级菜单</option>
                                    <?php echo $menuOptions; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">菜单名称</label>
                            <div class="layui-input-2">
                                <input type="text" class="layui-input field-title" name="title" lay-verify="required"
                                       autocomplete="off" placeholder="请输入菜单名称">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">图标设置</label>
                            <div class="layui-input-2">
                                <input type="text" class="layui-input field-icon" name="icon" lay-verify="required"
                                       autocomplete="off" placeholder="可自定义或使用系统图标">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-2">
                                <input type="text" class="layui-input field-sort" name="sort" lay-verify="required"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">菜单链接</label>
                            <div class="layui-input-2">
                                <input type="text" class="layui-input field-href" name="href" lay-verify="required"
                                       autocomplete="off" placeholder="请严格按照参考格式填写">
                            </div>
                            <div class="layui-form-mid layui-word-aux">
                                必填，模块格式：控制器名/方法名，插件直接设置：plugins/run，<span class="red">请留意大小写</span>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">状态设置</label>
                            <div class="layui-input-inline">
                                <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
                                <input type="radio" class="field-status" name="status" value="0" title="禁用">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">菜单/操作</label>
                            <div class="layui-input-inline">
                                <input type="radio" class="field-menu" name="menu" value="1" title="菜单" checked>
                                <input type="radio" class="field-menu" name="menu" value="0" title="操作">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <a class="layui-btn" lay-submit="" lay-filter="layform">保存</a>
                                <a class="layui-btn layui-btn-primary" href="<?php echo url('index'); ?>">返回</a>
                            </div>
                        </div>
                    </form>
                </div>
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
    layui.use(['func'], function () {
        layui.func.assign(<?php echo $info; ?>);
    });
</script>