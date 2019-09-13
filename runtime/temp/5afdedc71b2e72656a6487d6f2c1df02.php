<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\news\news_form.html";i:1559289220;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                    <form class="layui-form layui-row" lay-filter="form-news" action="<?php echo url('edit'); ?>">
                        <input type="hidden" name="id"/>

                        <div class="layui-col-md12">
                            <div class="layui-form-item">
                                <label class="layui-form-label">新闻标题</label>
                                <div class="layui-input-5">
                                    <input type="text" name="title" class="layui-input" lay-verify="required">
                                </div>
                                <label class="layui-form-label">新闻类别</label>
                                <div class="layui-input-inline">
                                    <select name="type_id" lay-verify="required" id="type_id">
                                        <option value="">请选择新闻类别</option>
                                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $vo['id']; ?>"
                                                {eq name='$vo.id' value='$info.id' }<!--selected{
                                        /eq}><?php echo $vo['type_name']; ?>--></option>
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

                                <label class="layui-form-label">是否至顶</label>
                                <div class="layui-input-inline">
                                    <input type="radio" name="top" value="1" title="正常">
                                    <input type="radio" name="top" value="2" title="至顶">
                                </div>
                                <label class="layui-form-label">是否显示</label>
                                <div class="layui-input-inline">
                                    <input type="radio" name="visible" value="1" title="显示">
                                    <input type="radio" name="visible" value="0" title="隐藏">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">新闻内容</label>
                                    <div class="layui-input-block">
                                        <textarea type="text" name="content" id="content"
                                                  placeholder="请输入内容"><?php echo $content; ?></textarea>
                                    </div>
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
    var url = "<?php echo url('Ueditor/index'); ?>";
    var ue = UE.getEditor('content', {
        initialFrameHeight: 250,
        zIndex: 100
    });
</script>
<script>
    layui.use(['form', 'laydate'], function () {
        var form = layui.form, $ = layui.jquery, laydate = layui.laydate;
        laydate.render({elem: '#create_time', type: 'datetime', value: new Date()});
        form.val("form-news", <?php echo $info; ?>);
    });
</script>

<!--
以下为使用wangeditor版本
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
                <form class="layui-form layui-row" lay-filter="form-news" action="<?php echo url('edit'); ?>">
                    <input type="hidden" name="id"/>
                    <div class="layui-card-body" pad15>
                        <div class="layui-col-md12">
                            <div class="layui-form-item">
                                <label class="layui-form-label">新闻标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="title" class="layui-input" lay-verify="required">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">新闻类别</label>
                                <div class="layui-input-inline">
                                    <select name="type_id" lay-verify="required" id="type_id">
                                        <option value="">请选择新闻类别</option>
                                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $vo['id']; ?>"
                                                {eq name='$vo.id' value='$info.id' }selected{
                                        /eq}><?php echo $vo['type_name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>

                                <label class="layui-form-label">发布时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="create_time" name="create_time" lay-verify="required"
                                           class="layui-input">
                                </div>

                                <label class="layui-form-label">是否至顶</label>
                                <div class="layui-input-inline">
                                    <input type="radio" name="top" value="1" title="正常">
                                    <input type="radio" name="top" value="2" title="至顶">
                                </div>
                                <label class="layui-form-label">是否显示</label>
                                <div class="layui-input-inline">
                                    <input type="radio" name="visible" value="1" title="显示">
                                    <input type="radio" name="visible" value="0" title="隐藏">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">新闻内容</label>
                                    <div class="layui-input-block">
                                        <div id="editor"><p><?php echo $content; ?></p></div>
                                        <textarea id="content" name="content"
                                                  style="width: 100%;height: 300px;display: none"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <a class="layui-btn" lay-submit="" lay-filter="layform">保存</a>
                                    <a href="<?php echo url('index'); ?>" class="layui-btn layui-btn-primary">返回</a>
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
<script type="text/javascript" src="/js/wangeditor/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor;
    var editor = new E('#editor');
    editor.customConfig.uploadImgShowBase64 = true;
    editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024;
    editor.customConfig.uploadFileName = 'file';  //上传的文件名
    editor.customConfig.showLinkImg = true; //是否开启网络图片，默认开启的。
    editor.customConfig.debug = true; //是否开启Debug 默认为false 建议开启 可以看到错误
    editor.customConfig.uploadImgServer = "<?php echo url('edtiorUpload'); ?>";  // 上传图片到服务器
    editor.customConfig.uploadImgHooks = {
        customInsert: function (insertImg, result, editor) {
            var url = result.data;
            insertImg(url);
        }
    };
    var $text = $("#content");
    editor.customConfig.onchange = function (html) {
        $text.val(html)
    };
    editor.customConfig.zIndex = 100;//防止挡住下拉列表框
    editor.create();
    $text.val(editor.txt.html());
</script>
<script>
    layui.use(['form', 'laydate'], function () {
        var form = layui.form, $ = layui.jquery, laydate = layui.laydate;
        laydate.render({elem: '#create_time', type: 'datetime', value: new Date()});
        form.val("form-news", <?php echo $info; ?>);
    });
</script>
-->
