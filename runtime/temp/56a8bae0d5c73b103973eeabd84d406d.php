<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpStudy\PHPTutorial\WWW\MyWeb\public/../application/admin\view\index\home.html";i:1560325818;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\header.html";i:1558084370;s:75:"D:\phpStudy\PHPTutorial\WWW\MyWeb\application\admin\view\common\footer.html";i:1558084370;}*/ ?>
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
<script src="/js/echarts.min.js"></script>
<div class="layui-fluid">
    <div class="layui-row layui-col-space10">

        <div class="layui-col-sm6 layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">
                    当日注册用户数
                    <span class="layui-badge layui-bg-blue layuiadmin-badge">人</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font"><?php echo $reg_num; ?></p>
                    <!--<p>
                        总计访问量
                        <span class="layuiadmin-span-color">88万 <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                    </p>-->
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">
                    当日活跃用户数
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">人</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font"><?php echo $login_num; ?></p>

                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">
                    总用户数
                    <span class="layui-badge layui-bg-green layuiadmin-badge">人</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">

                    <p class="layuiadmin-big-font"><?php echo $num; ?></p>

                </div>
            </div>
        </div>

        <div class="layui-col-sm6 layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">
                    留言数
                    <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font">0</p>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">
                    <i class="iconfont icon-dingdan1"></i>用户统计
                </div>
                <div class="layui-card-body">
                    <div id="graphic" class="">
                        <div id="main" class="main" style="height: 300px;"></div>

                        <a href="javascript:;" data-url="page/systemSetting/icons.html">
11

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">最新新闻</div>
                <div class="layui-card-body">
                    <table class="layui-table layuiadmin-page-table" lay-skin="line">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>标题</th>
                            <th>发布时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo !empty($_GET['page'])?($_GET['page']-1)*5+1+$key:$key+1; ?></td>
                            <td><a href="javascript:;" data-url="<?php echo url('news/view',['id'=>$vo['id']]); ?>"><?php echo $vo['title']; ?></a></td>
                            <td><?php if(!(empty($vo['create_time']) || (($vo['create_time'] instanceof \think\Collection || $vo['create_time'] instanceof \think\Paginator ) && $vo['create_time']->isEmpty()))): ?><?php echo date("Y-m-d H:i:s",$vo['create_time']); endif; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>
                    <?php echo $data->render(); ?>
                </div>
            </div>
        </div>-->

        </div>

    </div>
</div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '最近7天用户数'
        },
        tooltip: {
            show: true
        },
        legend: {},
        yAxis: [{
            type: 'value'
        }],
        xAxis: [],
        series: []
    };
    $.get('<?php echo url("user/statistics"); ?>').done(function(data) {
        myChart.setOption({
            legend: data.legend,
            xAxis: data.xAxis,
            series: data.series
        });
    });
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

</script>
<script src="/layui/layui.js"></script>
<script type="text/javascript">
    layui.config({
        base: '/js/'
    }).use('teach');
</script>

</body>
</html>
