<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\lost\lost_form.html";i:1560669890;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                <div class="layui-card-body" pad15>
                    <form class="layui-form layui-row" lay-filter="form-lost" action="<?php echo url('edit'); ?>">
                        <input type="hidden" name="id"/>
                        <div class="layui-col-md12">
                            <div class="layui-form-item">
                                <label class="layui-form-label">东西名称</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="thing" class="layui-input" lay-verify="required">
                                </div>
                                <label class="layui-form-label">你的姓名</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" class="layui-input" lay-verify="required">
                                </div>
                                <label class="layui-form-label">地点</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="address" class="layui-input" lay-verify="required">
                                </div>
                            </div>
                            <div>
                                <label class="layui-form-label">类别</label>
                                <div class="layui-input-inline">
                                    <select name="type_id" lay-verify="required" id="type_id">
                                        <option value="">请选择东西类别</option>
                                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $vo['id']; ?>"
                                                {eq name='$vo.id' value='$info.type.id' }selected{
                                        /eq}><?php echo $vo['type_name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">发布时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="create_time" name="create_time" lay-verify="required"
                                           class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">对物品描述</label>
                                <div class="layui-input-block">
                                    <textarea placeholder="请输入内容" name="content" class="layui-textarea" lay-verify="required"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <a class="layui-btn" lay-submit="" lay-filter="layform">保存</a>
                                    <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary">返回</a>
                                </div>
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
<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    // var url = "<?php echo url('Ueditor/index'); ?>";
    // var ue = UE.getEditor('content', {
    //     initialFrameHeight: 250,
    //     zIndex: 100
    // });
</script>
<script>
    layui.use(['form', 'laydate'], function () {
        var form = layui.form, $ = layui.jquery, laydate = layui.laydate;
        laydate.render({elem: '#create_time', type: 'datetime', value: new Date()});
        //create_time和time不同，不会调用new Date()方法
        form.val("form-lost", <?php echo $info; ?>);
    });
</script>
