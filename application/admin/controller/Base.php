<?php

/**
 * 控制器基类
 */

namespace app\admin\controller;

use think\Controller;
use think\Response;
use think\Request;
use think\exception\HttpResponseException;
use \traits\controller\Jump;  //使用简化的返回函数success,error

class Base extends Controller
{
    protected $adminRules, $HrefId;

    protected function _initialize()
    {
        //判断是否登录
        if (!session('userid')) {
            $this->redirect('admin/login/index');
        }

        define('CONTROLLER_NAME', strtolower(request()->controller()));
        define('ACTION_NAME', strtolower(request()->action()));
        //权限管理
        //当前操作权限ID
        if (session('userid') != 1) {
            $info         = db('user_rule')->where('href', CONTROLLER_NAME . '/' . ACTION_NAME)->find();
            $this->HrefId = $info['id'];
            //当前用户权限
            if (!cache('role_auth_' . session('roleid'))) {
                $rules = db('user')->alias('u')
                    ->join('user_role r', 'u.role_id = r.id', 'left')
                    ->where('u.id', session('userid'))
                    ->value('r.rules');
                cache('role_auth_' . session('roleid'), $rules);
            }
            $rules            = cache('role_auth_' . session('roleid'));
            $this->adminRules = explode(',', $rules);
            if ($this->HrefId) {
                if (!in_array($this->HrefId, $this->adminRules)) {
                    $this->error('您无此操作权限');
                } else {
                    $this->_systemLog($info['title']);
                }
            }
        }

    }

    /**
     * 系统日志记录
     */
    private function _systemLog($title)
    {
        // 系统日志记录
        $log             = [];
        $log['uid']      = session('userid');
        $log['username'] = session('username');
        $log['title']    = $title ? $title : '未加入系统菜单';
        $log['url']      = $this->request->url();
        $log['param']    = json_encode($this->request->param());
        $log['ctime']    = time();
        $log['ip']       = $this->request->ip();
        db('sys_log')->insert($log);
    }

    /**
     * @param $arr
     * @param $key_name
     * @return array
     * 将数据库中查出的列表以指定的 值作为数组的键名，并以另一个值作为键值
     */
    /*public static function convert($arr, $key_name, $value)
    {
        $arr2 = array();
        foreach ($arr as $key => $val) {
            $arr2[$val[$key_name]] = $val[$value];
        }
        return $arr2;
    }*/

    /**
     * 返回数据,一般用于不带分页的单条数据
     * @param $code 状态
     * @param $msg 提示信息
     * @param $data 要返回的数据
     */
    public static function show($data, $code = 0, $msg = '')
    {
        $res         = ['code' => $code];
        $res['msg']  = $msg;
        $res['data'] = $data;
        return $res;
        /*$response    = Response::create($res, "json");
        throw new HttpResponseException($response);*/
    }

    /**
     * 返回数据，一般用于带分页的多条数据对象
     * @param  [type]  $data     [description]
     * @param  integer $code [description]
     * @param  string $msg [description]
     */
    public static function showList($data, $code = 0, $msg = '')
    {
        $res['code'] = $code;
        $res['msg']  = $msg;
        if (!empty($data['total'])) {
            $res['count'] = $data['total'];
        } else {
            $res['count'] = 0;
        }
        $res['data'] = $data['data'];
        return $res;
        /*$response    = Response::create($res, "json");
        throw new HttpResponseException($response);*/
    }

}
