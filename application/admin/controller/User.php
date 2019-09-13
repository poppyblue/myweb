<?php

namespace app\admin\controller;

use app\admin\model\User as UserModel;

use think\Db;
use think\Request;

class User extends Base
{
    public function index()
    {
        if (request()->isPost()) {
            $key     = $this->request->post('key', '', 'trim');
            $role_id = $this->request->post('role', '0', 'intval');
            $limit   = $this->request->post('limit', config('paginate.list_rows'), 'intval');

            $where = '1=1 ';
            if ($key) {
                $where .= "and (nickname like '%" . $key . "%'";
                $where .= " or username like '%" . $key . "%'";
                $where .= " or realname like '%" . $key . "%')";
            }
            if ($role_id > 0) {
                $where .= " and (r.id=" . $role_id . ")";
            }

            $list = db('user')->alias('u')
                ->join('user_role r', 'u.role_id = r.id', 'left')
                ->field('u.*,r.role_name')
                ->where($where)
                ->order('role_id,u.id')
                ->paginate($limit)
                ->toArray();
            $list = $this->tableFormat($list);
            return $this->showList($list);
        } else {
            $list = db('user_role')->select();
            $this->assign('list', $list);
            return $this->fetch();
        }
    }

    protected function tableFormat($list)
    {
        foreach ($list['data'] as $k => $v) {
            //$list['data'][$k]['status'] = config('params.user')['status'][$v['status']];
            if ($v['login_time']) {
                $list['data'][$k]['login_time'] = getTime($v['login_time']);
            }
        }
        return $list;
    }

    //设置用户状态
    public function userStatus()
    {
        $id     = input('post.id');
        $status = input('post.status');
        if (db('user')->where('id=' . $id)->update(['status' => $status]) !== false) {
            return $this->success('设置成功!');
        } else {
            return $this->error('设置失败!');
        }
    }

    //用户编辑（包括新增、编辑）
    public function edit()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if ($data['id'] == null) {
                $user = db('user')->where(['username' => $data['username']])->find();
                if ($user) {
                    $this->error('用户名已经存在！');
                }
                $data['pwd']=md5('111111');
                db('user')->insert($data);
                return $this->success('用户添加成功！', 'index');
            } else {
                db('user')->update($data);
                return $this->success('用户编辑成功！', 'index');
            }
        } else {
            $id   = input('param.id');
            $info = null;
            if ($id) {
                $info = db('user')->where('id=' . $id)->find();
            }
            $this->assign('info', json_encode($info, true));

            $user_role = db('user_role')->select();
            $this->assign('list', $user_role);

            return $this->fetch('user_form');
        }
    }

    public function userDel()
    {
        db('user')->delete(input('post.id'));
        return $this->success('删除成功!');
    }

    public function userDelall()
    {
        $where = array('id' => array('in', explode(',', input('post.ids'))));
        db('user')->where($where)->delete();
        return $this->success('删除成功!');
    }


    //用户角色管理
    public function role()
    {
        if (request()->isPost()) {
            $list = db('user_role')->alias('r')
                ->join('user u', 'r.id=u.role_id', 'left')
                ->field('r.*,count(u.id) as num')
                ->group('r.id')
                ->select();
            return $this->show($list);
        }
        return $this->fetch();
    }

    public function roleEdit()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if ($data['id'] == null) {
                db('user_role')->insert($data);
                return $this->success('角色添加成功！', 'role');
            } else {
                db('user_role')->update($data);
                return $this->success('角色编辑成功！', 'role');
            }
        } else {
            $id   = input('param.id');
            $info = null;
            if ($id) {
                $info = db('user_role')->where('id=' . $id)->find();
            }
            $this->assign('info', json_encode($info, true));

            return $this->fetch('role_form');
        }
    }

    public function roleDel()
    {
        db('user_role')->delete(input('post.id'));
        return $this->success('删除成功!');
    }


    //个人信息维护
    public function info()
    {
        if (request()->isPost()) {
            $data = input('post.');

            //注意前台会传送过来file这个值，但这个值不属于数据库，因些使用unset将这个值从更新数据中删除
            //从而保证update时不会报错
            unset($data["file"]);

            db('user')->update($data);
            return $this->success('保存成功！');
        } else {
            $id   = session("userid");
            $info = db('user')->where('id=' . $id)->find();

            $this->assign('src', $info['avatar']);
            $this->assign('info', json_encode($info, true));
            return $this->fetch('user_info');
        }
    }

    public function infoSave()
    {
        return $this->info();
    }

    //修改密码
    public function pwdReset()
    {
        if(request()->isPost()){
            $data=input("post.");
            $user = db('user')->where('id', session("userid"))->find();
            if($user['pwd'] != md5($data['oldPassword'])){
                return $this->error('原密码错误!');
            }else{
                $data['id']=(string)(session("userid"));
                $data['pwd']=md5($data['pwd']);
                //注意要删除前台确认新密码的name属性和删除数据中的oldPassword的值，
                //因为加了的话会传到后台来而数据库没有此字段，会造成更新失败。
                unset($data['oldPassword']);

                if (db('user')->update($data)!==false) {
                    return $this->success('密码修改成功！');
                } else {
                    return $this->error('密码修改失败!');
                }
            }
        }else{
            return $this->fetch('pwd_reset');
        }
    }

    //用户统计
    public function statistics()
    {
        $userModel = new UserModel();
        $list_login = $userModel->stat_login();
        $list_reg = $userModel->stat_reg();

        $data = [
            'legend' => [
                'data' => ['新增记录', '活跃记录']
            ],
            'xAxis' => [
                [
                    'type' => 'category',
                    'data' => $list_login['day']
                ]
            ],
            'series' => [
                [
                    'name' => '新增记录',
                    'type' => 'bar',
                    'data' => $list_reg['data']
                ],
                [
                    'name' => '活跃记录',
                    'type' => 'bar',
                    'data' => $list_login['data']
                ]
            ]
        ];
        return $data;
    }


}