<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\auth\index.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
<link rel="stylesheet" href="/css/style.css" type="text/css">
<div class="layui-card">
    <div class="layui-tab layui-tab-brief">

        <div class="layui-tab-content page-tab-content">

            <div class="layui-tab-item layui-form menu-dl layui-show">
                <form class="page-list-form">
                    <dl class="menu-dl1 menu-hd mt10">
                        <dt>菜单名称</dt>
                        <dd>
                            <span class="hd">排序</span>
                            <span class="hd2">状态</span>
                            <span class="hd3">操作</span>
                        </dd>
                    </dl>
                    <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): $k = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                    <dl class="menu-dl1">
                        <dt>
                            <input type="checkbox" lay-skin="primary" title="<?php echo $v['title']; ?>">
                            <input type="text" class="menu-sort j-ajax-input" value="<?php echo $v['sort']; ?>">
                            <input type="checkbox" name="status" value="<?php echo $v['id']; ?>" <?php if($v['status'] == 1): ?>checked="" <?php endif; ?> lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" ">
                            <div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em><?php if($v['status'] == 1): ?>正常<?php else: ?>关闭<?php endif; ?></em><i></i></div>
                            <div class="menu-btns">
                                <a href="<?php echo url('edit?id='.$v['id']); ?>" title="编辑"><i
                                        class="layui-icon layui-icon-edit"></i></a>
                                <a href="<?php echo url('edit?pid='.$v['id']); ?>" title="添加子菜单"><i
                                        class="layui-icon layui-icon-add-1"></i></a>
                                <a id="<?php echo $v['id']; ?>" class="delete" title="删除"><i
                                        class="layui-icon layui-icon-delete"></i></a>
                            </div>
                        </dt>
                        <dd>
                            <?php if(is_array($v['childs']) || $v['childs'] instanceof \think\Collection || $v['childs'] instanceof \think\Paginator): $kk = 0; $__LIST__ = $v['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?>
                            <dl class="menu-dl2">
                                <dt>
                                    <input type="checkbox" lay-skin="primary" title="<?php echo $vv['title']; ?>">
                                    <input type="text" class="menu-sort j-ajax-input" value="<?php echo $vv['sort']; ?>">
                                    <input type="checkbox" name="status" value="<?php echo $vv['id']; ?>" <?php if($vv['status'] == 1): ?>checked="" <?php endif; ?> lay-skin="switch"
                                    lay-filter="switchStatus" lay-text="正常|关闭" >
                                    <div class="layui-unselect layui-form-switch layui-form-onswitch"
                                         lay-skin="_switch"><em><?php if($vv['status'] == 1): ?>正常<?php else: ?>关闭<?php endif; ?></em><i></i></div>
                                    <div class="menu-btns">
                                        <a href="<?php echo url('edit?id='.$vv['id']); ?>" title="编辑"><i
                                                class="layui-icon layui-icon-edit"></i></a>
                                        <a href="<?php echo url('edit?pid='.$vv['id']); ?>" title="添加子菜单"><i
                                                class="layui-icon layui-icon-add-1"></i></a>
                                        <a id="<?php echo $vv['id']; ?>" class="delete" title="删除"><i
                                                class="layui-icon layui-icon-delete"></i></a>
                                    </div>
                                </dt>

                                <?php if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $kkkk = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($kkkk % 2 );++$kkkk;?>

                                <dd>
                                    <input type="checkbox" lay-skin="primary" title="<?php echo $vvv['title']; ?>">
                                    <input type="text" class="menu-sort j-ajax-input" value="<?php echo $vvv['sort']; ?>">
                                    <input type="checkbox" name="status" value="<?php echo $vvv['id']; ?>" <?php if($vvv['status'] == 1): ?>checked="" <?php endif; ?> lay-skin="switch"
                                    lay-filter="switchStatus" lay-text="正常|关闭" >
                                    <div class="layui-unselect layui-form-switch layui-form-onswitch"
                                         lay-skin="_switch"><em><?php if($vvv['status'] == 1): ?>正常<?php else: ?>关闭<?php endif; ?></em><i></i></div>
                                    <div class="menu-btns">
                                        <a href="<?php echo url('edit?id='.$vvv['id']); ?>" title="编辑"><i
                                                class="layui-icon layui-icon-edit"></i></a>
                                        <a href="<?php echo url('edit?pid='.$vvv['id']); ?>" title="添加子菜单"><i
                                                class="layui-icon layui-icon-add-1"></i></a>
                                        <a id="<?php echo $vvv['id']; ?>" class="delete" title="删除"><i
                                                class="layui-icon layui-icon-delete"></i></a>
                                    </div>
                                </dd>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dl>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </dd>
                    </dl>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
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
    layui.use(['layer', 'form'], function () {
        var form = layui.form, layer = layui.layer;
        form.on('switch(switchStatus)', function (obj) {
            loading = layer.load(1, {shade: [0.1, '#fff']});
            var id = obj.elem.value;
            var status = obj.elem.checked === true ? 1 : 0;
            $.post('<?php echo url("menuStatus"); ?>', {'id': id, 'status': status}, function (res) {
                layer.close(loading);
                if (res.code == 1) {
                    layer.msg(res.msg, {time: 1000, icon: 1});
                } else {
                    layer.msg(res.msg, {time: 1000, icon: 2});
                }
            })
        });

        $('.delete').click(function () {
            var id = $(this).attr('id');
            layer.confirm('确定要删除?', function (index) {
                $.ajax({
                    url: "<?php echo url('menuDel'); ?>",
                    data: {id: id},
                    type: "post",
                    success: function (res) {
                        layer.msg(res.msg);
                        if (res.code == 1) {
                            setTimeout(function () {
                                location.href = res.url;
                            }, 1500)
                        }
                    }
                })
            })
        })
    });
</script>