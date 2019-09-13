<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\system\log.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                        <a class="layui-btn layui-btn-danger layui-btn-sm " id="delAll">批量删除</a>
                    </div>
                </form>
            </div>
            <table class="layui-table" id="list" lay-filter="list"></table>
        </div>
    </div>
</div>
<script type="text/javascript">
    layui.laytpl.toDateString = function(d, format){
        var date = new Date(d || new Date())
            ,ymd = [
            this.digit(date.getFullYear(), 4)
            ,this.digit(date.getMonth() + 1)
            ,this.digit(date.getDate())
        ]
            ,hms = [
            this.digit(date.getHours())
            ,this.digit(date.getMinutes())
            ,this.digit(date.getSeconds())
        ];

        format = format || 'yyyy-MM-dd HH:mm:ss';

        return format.replace(/yyyy/g, ymd[0])
            .replace(/MM/g, ymd[1])
            .replace(/dd/g, ymd[2])
            .replace(/HH/g, hms[0])
            .replace(/mm/g, hms[1])
            .replace(/ss/g, hms[2]);
    };

    //数字前置补零
    layui.laytpl.digit = function(num, length, end){
        var str = '';
        num = String(num);
        length = length || 2;
        for(var i = num.length; i < length; i++){
            str += '0';
        }
        return num < Math.pow(10, length) ? str + (num|0) : num;
    };
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
            url: '<?php echo url("log"); ?>',
            method: 'post',
            skin: 'row',
            even: true,
            page: true,
            cols: [[
                {checkbox: true, align: 'center'}
                , {type: 'numbers', title: '序号', width: 80}
                , {field: 'username', title: '操作者', width: 160}
                , {field: 'title', align: 'center', title: '操作名称'}
                , {field: 'url', align: 'center', title: '操作地址'}
                , {field: 'ip', align: 'center', title: 'IP地址', width: 120,}
                , {field: 'ctime', align: 'center', title: '操作时间', width: 220, templet : "<div>{{layui.util.toDateString(d.ctime*1000, 'yyyy年MM月dd日 HH:mm:ss')}}</div>"}
            ]],
            limits: [10, 20, 50, 100],
            limit: 10 //每页默认显示的数量
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
                    $.post("<?php echo url('logDelall'); ?>", {ids: ids}, function (data) {
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
