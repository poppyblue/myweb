<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\user\user_info.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                <form class="layui-form layui-row" lay-filter="form-info" action="<?php echo url('infoSave'); ?>">
                    <input type="hidden" name="id" />
                    <div class="layui-card-body" pad15>
                    <div class="layui-col-md3 layui-col-xs12 user_right">
                        <div class="layui-upload-list">
                            <input type="hidden" name="avatar" id="avatar">
                            <img class="layui-upload-img layui-circle" src="<?php echo $src; ?>" id="userFace">
                        </div>
                        <button type="button" id="imgBtn" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe67c;</i> 换个头像</button>
                    </div>
                    <div class="layui-col-md4 layui-col-xs12">
                        <div class="layui-form-item">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-block">
                                <input type="text" name="username" disabled class="layui-input layui-disabled">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">真实姓名</label>
                            <div class="layui-input-block">
                                <input type="text" name="realname" placeholder="请输入真实姓名" lay-verify="required" class="layui-input realName">
                            </div>
                        </div>
                        <div class="layui-form-item" pane="">
                            <label class="layui-form-label">性别</label>
                            <div class="layui-input-block userSex">
                                <input type="radio" name="gender" value="男" title="男" >
                                <input type="radio" name="gender" value="女" title="女">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号码</label>
                            <div class="layui-input-block">
                                <input type="tel" name="tel" placeholder="请输入手机号码" class="layui-input userPhone">
                            </div>
                        </div>


                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱</label>
                            <div class="layui-input-block">
                                <input type="text" name="email" placeholder="请输入邮箱" class="layui-input userEmail">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <a class="layui-btn" lay-submit="" lay-filter="layform">保存</a>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
<script>
    layui.use(['form', 'layer','upload'], function () {
        var form = layui.form, $ = layui.jquery, upload = layui.upload;
        form.val("form-info", <?php echo $info; ?>);
        var uploadInst = upload.render({
            elem: '#imgBtn'
            ,url: '<?php echo url("UpFiles/upload"); ?>'
            ,before: function(obj){
                obj.preview(function(index, file, result){
                    $('#userFace').attr('src', result); //图片链接（base64）
                });
            },
            done: function(res){
                if(res.code>0){
                    $('#avatar').val(res.url);
                }else{
                    return layer.msg('上传失败');
                }
            }
        });
    });
</script>
