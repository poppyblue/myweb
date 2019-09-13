<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\auth\rule.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
<link rel="stylesheet" href="/js/zTree/css/zTreeStyle.css" type="text/css">
<div class="layui-fluid">
    <div class="layui-card">
        <form class="layui-form">
            <ul id="treeDemo" class="ztree"></ul>
            <div class="layui-form-item text-center">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit">保存</button>
                <button class="layui-btn layui-btn-danger" type="button" onclick="window.history.back()">返回</button>
            </div>
        </form>
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
<script type="text/javascript" src="/js/zTree/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/js/zTree/js/jquery.ztree.excheck.min.js"></script>
<script type="text/javascript">
    var setting = {
        check: {enable: true},
        view: {showLine: false, showIcon: false, dblClickExpand: false},
        data: {
            simpleData: {enable: true, pIdKey: 'pid', idKey: 'id'},
            key: {name: 'title'}
        }
    };
    var zNodes = <?php echo $data; ?>;

    function setCheck() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.check.chkboxType = {"Y": "s", "N": "s"};
    }

    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    setCheck();
    layui.use(['form', 'layer'], function () {
        var form = layui.form, layer = layui.layer;
        form.on('submit(submit)', function () {
            loading = layer.load(1, {shade: [0.1, '#fff']});
            // 提交到方法 默认为本身
            var treeObj = $.fn.zTree.getZTreeObj("treeDemo"),
                nodes = treeObj.getCheckedNodes(true),
                v = "";
            for (var i = 0; i < nodes.length; i++) {
                v += nodes[i].id + ",";
            }
            var id = "<?php echo input('id'); ?>";
            $.post("<?php echo url('setAccess'); ?>", {'rules': v, 'id': id}, function (res) {
                layer.close(loading);
                if (res.code > 0) {
                    layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                        location.href = res.url;
                    });
                } else {
                    layer.msg(res.msg, {time: 1800, icon: 2});
                }
            });
        })
    });
</script>