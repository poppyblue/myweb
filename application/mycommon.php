<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

function savecache($name = '', $id = '')
{
    if ($name == 'Field') {
        if ($id) {
            $Model = db($name);
            $data  = $Model->order('sort')->where('moduleid=' . $id)->column('*', 'field');
            $name  = $id . '_' . $name;
            $data  = $data ? $data : null;
            cache($name, $data);
        } else {
            $module = cache('Module');
            foreach ($module as $key => $val) {
                savecache($name, $key);
            }
        }
    } elseif ($name == 'System') {
        $Model = db($name);
        $list  = $Model->where(array('id' => 1))->find();
        cache($name, $list);
    } elseif ($name == 'Module') {
        $Model     = db($name);
        $list      = $Model->order('sort')->select();
        $pkid      = $Model->getPk();
        $data      = array();
        $smalldata = array();
        foreach ($list as $key => $val) {
            $data [$val [$pkid]]     = $val;
            $smalldata[$val['name']] = $val [$pkid];
        }
        cache($name, $data);
        cache('Mod', $smalldata);
    } elseif ($name == 'cm') {
        $list = db('category')
            ->alias('c')
            ->join('module m', 'c.moduleid = m.id')
            ->order('c.sort')
            ->field('c.*,m.title as mtitle,m.name as mname')
            ->select();
        cache($name, $list);
    } else {
        $Model = db($name);
        $list  = $Model->order('sort')->select();
        $pkid  = $Model->getPk();
        $data  = array();
        foreach ($list as $key => $val) {
            $data [$val [$pkid]] = $val;
        }
        cache($name, $data);
    }
    return true;
}

/**
 * 验证输入的邮件地址是否合法
 */
function is_email($user_email)
{
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false) {
        if (preg_match($chars, $user_email)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * 是否是手机号码，含虚拟运营商的170号段
 * @author wei sun
 * @param string $phone 手机号码
 * @return boolean
 */
function is_phone($phone)
{
    if (is_numeric($phone) && strlen($phone) == 11 && substr($phone, 0, 1) == 1) {
        return true;
    }
    return false;
}

/**
 * 邮件发送
 * @param $to    接收人
 * @param string $subject 邮件标题
 * @param string $content 邮件内容(html模板渲染后的内容)
 * @throws Exception
 * @throws phpmailerException
 */
function send_email($to, $subject = '', $content = '')
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    /*$arr    = db('config')->where('type', 'smtp')->select();
    $config = convert($arr, 'name', 'value');*/

    $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    //调试输出格式
    //$mail->Debugoutput = 'html';
    //smtp服务器
    $mail->Host = config('web.smtp_server');
    //端口 - likely to be 25, 465 or 587
    $mail->Port = config('web.smtp_port');//$config['smtp_port'];

    if ($mail->Port == '465') {
        $mail->SMTPSecure = 'ssl';
    }// 使用安全协议
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //发送邮箱
    $mail->Username = config('web.smtp_user');//$config['smtp_user'];
    //密码
    $mail->Password = config('web.smtp_pwd');//$config['smtp_pwd'];
    //Set who the message is to be sent from
    $mail->setFrom(config('web.smtp_user'), config('web.smtp_id'));
    //回复地址
    //$mail->addReplyTo('replyto@example.com', 'First Last');
    //接收邮件方
    if (is_array($to)) {
        foreach ($to as $v) {
            $mail->addAddress($v);
        }
    } else {
        $mail->addAddress($to);
    }

    $mail->isHTML(true);// send as HTML
    //标题
    $mail->Subject = $subject;
    //HTML内容转换
    $mail->msgHTML($content);
    return $mail->send();
}

// 应用公共文件
function convert($arr, $key_name, $value)
{
    $arr2 = array();
    foreach ($arr as $key => $val) {
        $arr2[$val[$key_name]] = $val[$value];
    }
    return $arr2;
}

/**
 * 时间格式化
 * @param int $time
 * @return false|string
 */
function getTime($time = 0)
{
    return date('Y-m-d H:i:s', $time);
}
