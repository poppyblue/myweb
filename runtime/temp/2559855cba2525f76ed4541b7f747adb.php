<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\user\user_form.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
                <form class="layui-form layui-row" lay-filter="form-user" action="<?php echo url('edit'); ?>">
                    <input type="hidden" name="id" />
                    <div class="layui-card-body" pad15>
                        <div class="layui-col-md4">
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="username" class="layui-input" lay-verify="required">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户角色</label>
                                <div class="layui-input-block">
                                    <select name="role_id" lay-verify="required"  id="role_id">
                                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $vo['id']; ?>" {eq name='$vo.id' value='$info.id'
                                                }selected{
                                        /eq}><?php echo $vo['role_name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">真实姓名</label>
                                <div class="layui-input-block">
                                    <input type="text" name="realname" placeholder="请输入真实姓名" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">手机号码</label>
                                <div class="layui-input-block">
                                    <input type="text" name="tel" placeholder="请输入手机号码" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">邮箱</label>
                                <div class="layui-input-block">
                                    <input type="text" name="email" placeholder="请输入邮箱" class="layui-input">
                                    <div class="layui-form-mid layui-word-aux">请填写正确邮箱，用于找回密码。</div>
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
<script>
    layui.use('form', function () {
        var form = layui.form, $ = layui.jquery;
        form.val("form-user", <?php echo $info; ?>);
    });
</script>
