<?php
/**
 * Created by PhpStorm.
 * User: 周世豪
 * Date: 2019/6/21
 * Time: 8:37
 */

namespace app\admin\controller;


class Student extends Base
{
    public function index()
    {
        if (request()->isPost()) {
            $key     = $this->request->post('key', '', 'trim');
            //$role_id = $this->request->post('role', '0', 'intval');
            $limit   = $this->request->post('limit', config('paginate.list_rows'), 'intval');

            $where = '1=1 ';
            if ($key) {
                $where .= "and (nickname like '%" . $key . "%'";
                $where .= " or username like '%" . $key . "%'";
                $where .= " or realname like '%" . $key . "%')";
            }
//            if ($role_id > 0) {
//                $where .= " and (r.id=" . $role_id . ")";
//            }

            $list = db('student')->alias('s')
                //->join('user_role r', 'u.role_id = r.id', 'left')
                ->field('s.*')
                ->where($where)
               // ->order('role_id,u.id')
                ->paginate($limit)
                ->toArray();
            $list = $this->tableFormat($list);
            return $this->showList($list);
        } else {
            $list = db('student')->select();
            $this->assign('list', $list);
            return $this->fetch();
        }
    }
//    public function course()
//    {
//        if (request()->isPost()) {
//            $list = db('course')->alias('c')
//                ->field('c.*')
//                ->select();
//            return $this->show($list);
//        }
//        return $this->fetch();
//    }
//
//    public function edit()
//    {
//        if (request()->isPost()) {
//            $data = input('post.');
//            if ($data['id'] == null) {
//                $data['user_id'] = session('userid');
//                db('student')->insert($data);
//                return $this->success('学生添加成功！', 'index');
//            } else {
//                db('student')->update($data);
//                return $this->success('学生编辑成功！', 'index');
//            }
//        } else {
//            $id = input('param.id');
//            $info = null;
//            if ($id) {
//                $info = db('student')->where('id=' . $id)->find();
//            }
//            $this->assign('info', json_encode($this->dataFormat($info), true));
//            $name = db('student')->select();
//            $this->assign('list', $name);
//            return $this->fetch('stu_form');
//        }
//    }
//    public function courseEdit()
//    {
//        if (request()->isPost()) {
//            $data = input('post.');
//            if ($data['id'] == null) {
//                $data['id']=session('id');
//                db('course')->insert($data);
//                return $this->success('课程添加成功！', 'type');
//            } else {
//                db('course')->update($data);
//                return $this->success('课程编辑成功！', 'type');
//            }
//        } else {
//            $id = input('param.id');
//            $info = null;
//            if ($id) {
//                $info = db('course')->where('id=' . $id)->find();
//            }
//            $this->assign('info', json_encode($info, true));
//            return $this->fetch('course_form');
//        }
//    }
//    public function stuDel()
//    {
//        db('student')->delete(input('post.id'));
//        return $this->success('删除成功!');
//    }
//    public function courseDel()
//    {
//        db('course')->delete(input('post.id'));
//        return $this->success('删除成功!');
//    }
//    /*protected function dataFormat($data)
//    {
//        if ($data['create_time']) {
//            $data['create_time'] = getTime($data['create_time']);
//        }
//        //由于插件原因，必须将整形数转换为字符串型前台的form.val函数才能将单选初始化
//        if ($data['visible']) {
//            $data["visible"] = strval($data["visible"]);
//        }
//        if ($data['top']) {
//            $data["top"] = strval($data["top"]);
//        }
//        return $data;
//    }
    protected function tableFormat($list)
    {
        foreach ($list['data'] as $k => $v) {
            if ($v['create_time']) {
                $list['data'][$k]['create_time'] = getTime($v['create_time']);
            }
        }
        return $list;
    }
//    public function view()
//    {
//        return $this->fetch();
//    }
}