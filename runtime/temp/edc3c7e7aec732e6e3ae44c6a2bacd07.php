<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\lost\claimindex.html";i:1560670966;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
            <table class="layui-table" id="list" lay-filter="list"></table>
        </div>
    </div>
</div>

<script type="text/html" id="action">
    <?php if((session('roleid')==7)): ?>
    <!--管理员才显示编辑和删除操作-->
    <a href="<?php echo url('agree'); ?>?id={{d.id}}" class="layui-btn layui-btn-xs">同意</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="ref">不同意</a>
    <!--同意我将status=1不同意则c_status=1-->
    <?php endif; ?>
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
            url: '<?php echo url("claimindex"); ?>',
            method: 'post',
            page: true,
            cols: [[
                {checkbox: true, align: 'center'}
                , {type: 'numbers', align: 'center', title: '序号'}
                , {field: 'thing', align: 'center', title: '物品名称'}
                , {field: 'name', align: 'center', title: '捡到人姓名'}
                , {field: 'create_time', align: 'center', title: '时间', width: 200}
                , {field: 'address', align: 'center', title: '地点'}
                , {field: 'content', align: 'center', title: '捡到人的备注'}
                , {field: 'c_name', align: 'center', title: '失主的姓名'}
                , {field: 'c_content', align: 'center', title: '失主的备注'}
                , {width: 160, align: 'center', title: '操作', toolbar: '#action'}
            ]],
            limits: [10, 20, 50, 100],
            limit: 10 //每页默认显示的数量
        });
        table.on('tool(list)', function (obj) {
            var data = obj.data;
            if (obj.event === 'ref') {
                var lostnum=data.num;
                if(lostnum!=0) {
                    layer.confirm('您确定不同意吗？', function (index) {
                        var loading = layer.load(1, {shade: [0.1, '#fff']});

                        $.post("<?php echo url('refuse'); ?>", {id: data.id}, function (res) {
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
