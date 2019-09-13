<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\student\course.html";i:1561080444;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="table-head-btn">
                <form class="layui-form seller-form">
                    <a href="<?php echo url('courseEdit'); ?>" class="layui-btn layui-btn-sm" style="float:right;">添加课程</a>
                </form>
            </div>
            <table class="layui-table" id="list" lay-filter="list"></table>
        </div>
    </div>
</div>

<script type="text/html" id="action">
    <a href="<?php echo url('courseEdit'); ?>?id={{d.id}}" class="layui-btn layui-btn-xs">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script src="/layui/layui.js"></script>
<script type="text/javascript">
    layui.config({
        base: '/js/'
    }).use('teach');
</script>

</body>
</html>

<script>
    layui.use(['layer', 'table', 'form'], function () {
        var form = layui.form, table = layui.table, layer = layui.layer;
        var tableIn = table.render({
            id: 'data',
            elem: '#list',
            url: '<?php echo url("course"); ?>',
            method: 'post',
            page: true,
            cols: [[
                {checkbox: true, align: 'center'}
                , {type: 'numbers', align: 'center', title: '序号', width: 80}
                , {field: 'course', align: 'center', title: '课程类别'}
                , {width: 160, align: 'center', title: '操作', toolbar: '#action'}
            ]],
            limits: [10, 20, 50, 100],
            limit: 10 //每页默认显示的数量
        });
        $('#search').on('click', function () {
            var key = $('#key').val();
            var type = $('#type').val();
            tableIn.reload({page: {page: 1}, where: {key: key, type: type}});
        });
        table.on('tool(list)', function (obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('您确定要删除吗？', function (index) {
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('courseDel'); ?>", {id: data.id}, function (res) {
                        layer.close(loading);
                        if (res.code === 1) {
                            layer.msg(res.msg, {time: 1000, icon: 1});
                            tableIn.reload();
                        } else {
                            layer.msg('操作失败！', {time: 1000, icon: 2});
                        }
                    });
                    layer.close(index);
                });
            }
        });
    });
</script>
