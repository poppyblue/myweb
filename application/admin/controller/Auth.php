<?php

namespace app\Admin\controller;

use think\Controller;

class Auth extends Controller
{
    public function index()
    {
        $map        = [];
        $map['pid'] = 0;
        //$menu_list =db('user_rule')->where($map)->order('sort asc,id asc')->select(); //$this->getAllChild(0);
        $menu_list = $this->getAllChild(0);
        $this->assign('menu_list', $menu_list);
        return $this->fetch();
    }

    public function getAllChild($pid = 0, $field = 'id,pid,title,href,sort,status', $level = 0, $data = [])
    {
        $trees = [];
        if (empty($trees)) {
            if (empty($data)) {
                $data = db('user_rule')->order('sort asc,id asc')->column($field);
                $data = array_values($data);
            }
            foreach ($data as $k => $v) {
                if ($v['pid'] == $pid) {
                    unset($data[$k]);
                    $v['childs'] = self::getAllChild($v['id'], $field, $level + 1, $data);
                    $trees[]     = $v;
                }
            }
        }
        return $trees;
    }


    public function edit()
    {
        if (request()->isPost()) {

            $data = input('post.');
            if ($data['id'] == null) {
                db('user_rule')->insert($data);
                return $this->success('添加成功！', url('index'));
            } else {
                db('user_rule')->update($data);
                return $this->success('编辑成功！', url('index'));
            }
        } else {
            $id   = input('param.id');
            $info = null;
            if ($id) {
                $info = db('user_rule')->where('id=' . $id)->find();
            }
            $pid = input('param.pid');
            $this->assign('menuOptions', self::menuOption($pid));
            $this->assign('info', json_encode($info, true));

            return $this->fetch('form');
        }
    }

    /**
     * 下拉菜单
     */
    private function menuOption($id = '', $str = '')
    {
        $menus = $this->getAllChild();

        foreach ($menus as $v) {

            if ($id == $v['id']) {
                $str .= '<option level="1" value="' . $v['id'] . '" selected>' . $v['title'] . '</option>';
            } else {
                $str .= '<option level="1" value="' . $v['id'] . '">' . $v['title'] . '</option>';
            }
            if ($v['childs']) {
                foreach ($v['childs'] as $vv) {
                    if ($id == $vv['id']) {
                        $str .= '<option level="2" value="' . $vv['id'] . '" selected>|— ' . $vv['title'] . '</option>';
                    } else {
                        $str .= '<option level="2" value="' . $vv['id'] . '">|— ' . $vv['title'] . '</option>';
                    }
                    if ($vv['childs']) {
                        foreach ($vv['childs'] as $vvv) {
                            if ($id == $vvv['id']) {
                                $str .= '<option level="3" value="' . $vvv['id'] . '" selected>|— |— ' . $vvv['title'] . '</option>';
                            } else {
                                $str .= '<option level="3" value="' . $vvv['id'] . '">|— |— ' . $vvv['title'] . '</option>';
                            }
                        }
                    }
                }
            }
        }
        return $str;
    }

    public function rule()
    {
        $admin_rule = db('user_rule')->field('id,pid,title')->order('sort asc')->select();
        $rules      = db('user_role')->where('id', input('id'))->value('rules');
        $arr        = $this->auth($admin_rule, $pid = 0, $rules);
        $arr[]      = array(
            "id"    => 0,
            "pid"   => 0,
            "title" => "全部",
            "open"  => true
        );
        $this->assign('data', json_encode($arr, true));
        return $this->fetch();
    }


    public function menuStatus()
    {
        $id     = input('post.id');
        $status = input('post.status');
        if (db('user_rule')->where('id=' . $id)->update(['status' => $status]) !== false) {
            return $this->success('设置成功!');
        } else {
            return $this->error('设置失败!');
        }
    }

    public function menuDel()
    {
        $id      = input('post.id');
        $submenu = db('user_rule')->where("pid=" . $id)->find();
        if ($submenu) {
            return $this->error('该菜单下有子菜单，删除失败!');
        } else {
            $result = db('user_rule')->where("id=" . $id)->delete();
            if ($result)
                return $this->success('删除成功!', '/admin/auth/index');
            else
                return $this->error('删除失败!');
        }
    }

    public function setAccess()
    {
        $data = input('param.');
        if (empty($data['rules'])) {
            return $this->error('请选择权限!');
        }
        //清除角色权限缓存
        cache('role_auth_' . $data['id'], null);
        $success    = db('user_role')->update($data);
        if ($success) {
            return $this->success('权限配置成功!');
        } else {
            return $this->error('保存错误!');
        }
    }

    public function auth($cate, $pid = 0, $rules)
    {
        $arr      = array();
        $rulesArr = explode(',', $rules);
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                if (in_array($v['id'], $rulesArr)) {
                    $v['checked'] = true;
                }
                $v['open'] = true;
                $arr[]     = $v;
                $arr       = array_merge($arr, self::auth($cate, $v['id'], $rules));
            }
        }
        return $arr;
    }

}
