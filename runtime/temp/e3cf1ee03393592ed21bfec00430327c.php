<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\lost\type.html";i:1560166379;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
            <a href="<?php echo url('typeEdit'); ?>" class="layui-btn layui-btn-sm" style="float:right;">添加东西类别</a>
            <table class="layui-table" id="list" lay-filter="list"></table>
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
<script type="text/html" id="action">
    <a href="<?php echo url('typeEdit'); ?>?id={{d.id}}" class="layui-btn layui-btn-xs">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table', 'form'], function () {
        var table = layui.table, form = layui.form, $ = layui.jquery;
        var tableIn = table.render({
            id: 'data',
            elem: '#list',
            url: '<?php echo url("lost/type"); ?>',
            method: 'post',
            cols: [[
                {type: 'numbers', title: '序号', width: 80},
                {field: 'type_name', align: 'center', title: '类别名', width: 300},
                {align: 'center', title: '操作', toolbar: '#action'}
            ]]
        });

        table.on('tool(list)', function (obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                var lostnum=data.num;
                if(lostnum!=0) {
                    layer.confirm('您确定要删除吗？', function (index) {
                        var loading = layer.load(1, {shade: [0.1, '#fff']});

                        $.post("<?php echo url('typeDel'); ?>", {id: data.id}, function (res) {
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
                }else{
                    layer.msg("不能删除！", {time: 1800, icon: 2});
                }
            }
        });
    });
</script>