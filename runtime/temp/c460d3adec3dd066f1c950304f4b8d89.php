<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\news\index.html";i:1559285358;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                    <div class="layui-inline">
                        <input class="layui-input" name="key" id="key" placeholder="请输入关键字" autocomplete="off">
                    </div>
                    <div class="layui-inline">
                        <select id="type">
                        <option value="">请选择类别</option>
                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['type_name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    </div>
                    <div class="layui-inline">
                        <a class="layui-btnse layui-btn-sm" id="search">搜索数据</a>
                        <a class="layui-btn layui-btn-danger layui-btn-sm " id="delAll">批量删除</a>
                        <a class="layui-btn layui-btn-sm" href="<?php echo url('index'); ?>">显示全部</a>
                    </div>
                    <a href="<?php echo url('edit'); ?>" class="layui-btn layui-btn-sm" style="float:right;">添加新闻</a>
                </form>
            </div>
            <table class="layui-table" id="list" lay-filter="list"></table>
        </div>
    </div>
</div>
<script type="text/html" id="visible">
    <input type="checkbox" name="visible" value="{{d.id}}" lay-skin="switch"
           lay-text="正常|隐藏" lay-filter="visible" {{d.visible== 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="top">
    <input type="checkbox" name="top" value="{{d.id}}" lay-skin="switch"
           lay-text="正常|至顶" lay-filter="top" {{d.top== 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="action">
    <a href="<?php echo url('edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-xs">编辑</a>
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
            url: '<?php echo url("index"); ?>',
            method: 'post',
            page: true,
            cols: [[
                {checkbox: true, align: 'center'}
                , {type: 'numbers', title: '序号', width: 80}
                , {field: 'title', title: '标题', width: 160}
                , {field: 'type_name', align: 'center', title: '新闻类别'}
                , {field: 'visible', align: 'center', title: '显示', width: 120, toolbar: '#visible'}
                , {field: 'top', align: 'center', title: '至顶', width: 120, toolbar: '#top'}
                , {field: 'create_time', align: 'center', title: '发布时间', width: 180}
                , {width: 160, align: 'center', title: '操作', toolbar: '#action'}
            ]],
            limits: [10, 20, 50, 100],
            limit: 10 //每页默认显示的数量
        });

        //搜索
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
                    $.post("<?php echo url('newsDel'); ?>", {id: data.id}, function (res) {
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

        form.on('switch(visible)', function (obj) {
            loading = layer.load(1, {shade: [0.1, '#fff']});
            var id = this.value;
            var visible = obj.elem.checked === true ? 1 : 0;
            $.post('<?php echo url("newsVisible"); ?>', {'id': id, 'visible': visible}, function (res) {
                layer.close(loading);
                if (res.code == 1) {
                    layer.msg(res.msg, {time: 1000, icon: 1});
                } else {
                    layer.msg(res.msg, {time: 1000, icon: 2});
                }
            })
        });

        form.on('switch(top)', function (obj) {
            loading = layer.load(1, {shade: [0.1, '#fff']});
            var id = this.value;
            var top = obj.elem.checked === true ? 1 : 0;
            $.post('<?php echo url("newsTop"); ?>', {'id': id, 'top': top}, function (res) {
                layer.close(loading);
                if (res.code == 1) {
                    layer.msg(res.msg, {time: 1000, icon: 1});
                } else {
                    layer.msg(res.msg, {time: 1000, icon: 2});
                }
            })
        });

        $('#delAll').on('click', function () {
            var checkStatus = table.checkStatus('data');//注意此处的值必须和table.render({id: 'data',处的值相同
            var data = checkStatus.data;
            var ids = "";
            if (data.length == 0) {
                layer.msg('请选择要删除的数据！');
                return;
            } else {
                for (var i = 0; i < data.length; i++) {
                    ids += data[i].id + ",";
                }
                layer.confirm('确认要删除选中信息吗？', {icon: 3}, function (index) {
                    layer.close(index);
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('userDelall'); ?>", {ids: ids}, function (data) {
                        layer.close(loading);
                        if (data.code === 1) {
                            layer.msg(data.msg, {time: 1000, icon: 1});
                            tableIn.reload();
                        } else {
                            layer.msg(data.msg, {time: 1000, icon: 2});
                        }
                    });
                });
            }
        })

    });
</script>
