<?php

namespace app\admin\controller;

use think\Cache;
use think\Controller;
use think\captcha\Captcha;

class Login extends Controller
{
    private $cache_model, $system;

    public function _initialize()
    {
        if (session('userid')) {
            $this->redirect('admin/index/index');
        }
        /*$this->cache_model = array('Module', 'AuthRule', 'Category', 'Posid', 'Field', 'System');
        $this->system = cache('System');
        $this->assign('system', $this->system);
        if (empty($this->system)) {
            foreach ($this->cache_model as $r) {
                savecache($r);
            }
        }*/
    }

    public function index()
    {
        if (request()->isPost()) {
            $data = input('post.');
            /*if (!$this->check($data['vercode'])) {
                return $this->error('验证码错误');
            }*/
            $user = db('user')->where('username', $data['username'])->find();
            if ($user) {
                if ($user['status'] == 1 && $user['pwd'] == md5($data['password'])) {
                    session('username', $user['username']);
                    session('userid', $user['id']);
                    session('roleid', $user['role_id']);
                    db('user')->where('id', $user['id'])->update(['login_time' => time()]);
                    return $this->success('登录成功!'); //信息正确
                } else {
                    return $this->error('用户名或者密码错误，重新输入!'); //密码错误
                }
            } else {
                return $this->error('用户不存在!'); //用户不存在
            }
        } else {
            return $this->fetch();
        }
    }

    public function check($code)
    {
        return captcha_check($code);
    }

    //忘记密码
    public function checkCode()
    {
        if (request()->isPost()) {
            $data = input('post.');
            /*if (!$this->check($data['vercode'])) {
                return $this->error('验证码错误');
            } else*/ //{
                $email = $data['email'];
                $user  = db('user')->where('email', $email)->find();
                if ($user) {
                    $code = mt_rand(999, 9999);
                    $send = send_email($email, '邮箱验证码', $code);
                    if ($send) {
                        Cache::set($email, $code, 120);
                        return $this->success('邮件验证码发送成功，2分钟内有效！');
                    } else {
                        return $this->error('邮件发送失败！');
                    }
                } else {
                    return $this->error('该邮箱未与用户绑定！');
                }
           // }
        }
    }

    public function forget()
    {
        if (request()->isPost()) {
            $email         = input('post.email');
            $email_captcha = input('post.emailCaptcha');
            $right_code    = Cache::get($email);
            if ($right_code == $email_captcha) {
                session('chgEmail', $email);
                return $this->success('验证正确', 'login/setPwd');
            } else {
                return $this->error('邮箱码错误或超时，请重试！');
            }
        } else {
            return $this->fetch();
        }
    }

    public function setPwd()
    {
        if (request()->isPost()) {
            $data        = input("post.");
            $data['pwd'] = md5($data['pwd']);
            if (db('user')->where('email', $data['email'])->update($data) !== false) {
                session('chgEmail', null);
                return $this->success('密码设置成功！', 'login/index');
            } else {
                return $this->error('密码设置失败!');
            }
        } else {
            return $this->fetch('pwd_new');
        }

    }


    //用户注册
    public function reg()
    {
        if (request()->isPost()) {
            $data = input('post.');
            /*if (!$this->check($data['vercode'])) {
                return $this->error('验证码错误');
            }*/
            $user = db('user')->where('username', $data['username'])->find();
            if ($user) {
                return $this->error('该用户名已经注册!');
            } else {
                $email = db('user')->where('email', $data['email'])->find();
                if ($email) {
                    return $this->error('该邮箱已经注册!');
                } else {
                    unset($data['vercode']);
                    $data['nickname'] = $data['username'];
                    $data['pwd']      = md5($data['pwd']);
                    $data['reg_time'] = time();
                    db('user')->insert($data);
                    return $this->success('注册成功!', 'index');
                }
            }
        } else {
            return $this->fetch();
        }
    }

}