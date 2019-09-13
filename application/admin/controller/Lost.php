<?php

namespace app\Admin\controller;

use app\admin\model\Config;
use think\console\command\make\Model;
use think\Log;

/**
 *     lost
 */
class Lost extends Base
{
    //输出招领表
    public function index()
    {
        if (request()->isPost()) {
            //以下代码均跟查找有关
            $key = $this->request->post('key', '', 'trim');
            $type_id = $this->request->post('type', '0', 'intval');
            $limit = $this->request->post('limit', config('paginate.list_rows'), 'intval');
            $where = '1=1 ';
            if ($key) {
                $where .= "and (title like '%" . $key . "%'";
                $where .= " or content like '%" . $key . "%')";
            }
            if ($type_id > 0) {
                $where .= " and (t.id=" . $type_id . ")";
            }
            $data = input('post.');
            $data['user_id']=session('roleid');
            if($data['user_id']==7) {
                //=1为管理员
                $list = db('lost')
                    ->alias('n')
                    ->join('lost_type t', 'n.type_id=t.id', 'left')
                    ->where('n.status',0)
                    ->where($where)
                    ->field('n.id,n.thing,n.name,t.type_name,n.create_time,n.address,n.content')
                    ->group('n.id')
                    ->order('n.create_time','DESC')
                    ->paginate($limit)
                    ->toArray();
                //return $this->success("123");
            }
            else{
                //不为管理员
                $list = db('lost')
                    ->alias('n')
                    ->join('lost_type t', 'n.type_id=t.id', 'left')
                    ->where('n.status',0)
                    ->where($where)
                    ->field('n.id,n.thing,n.name,t.type_name,n.create_time,n.address')
                    ->group('n.id')
                    ->order('n.create_time','DESC')
                    ->paginate($limit)
                    ->toArray();
            }
            $list = $this->tableFormat($list);
            return $this->showList($list);
        }
        else {
            $list = db('lost_type')->select();
            $this->assign('list', $list);
            return $this->fetch();
        }
    }

    //添加编辑失物信息
    public function edit()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            $data['create_time'] = strtotime($data['create_time']);
            if ($data['id'] == null)
            {
                $data['id'] = session('id');
                db('lost')
                    ->insert($data);
                return $this->success('添加成功！', 'index');
            }
            else {
                db('lost')
                    ->update($data);
                return $this->success('编辑成功！', 'index');
            }
        }
        else {
            $id = input('param.id');
            $info = null;
            if ($id) {
                $info = db('lost')->where('id',$id)->find();
            }
//            $this->assign('info', json_encode($info, true));
            $this->assign('info', json_encode($this->dataFormat($info), true));
            $lost_type = db('lost_type')->select();
            $this->assign('list', $lost_type);
            return $this->fetch('lost_form');
        }
    }

    //输出认领表
    public function claimindex()
    {
        if (request()->isPost()) {
            $limit = $this->request->post('limit', config('paginate.list_rows'), 'intval');
            $data = input('post.');
            $data['user_id']=session('roleid');
            //user_id=1为管理员
            if($data['user_id']==7){
                $list = db('claim')
                    ->alias('c')
                    ->join('lost l', 'c.lost_id=l.id', 'right')
                    ->where('c.c_status', 0)
                    ->field('l.id,l.thing,l.name,l.create_time,l.address,l.content,c.c_name,c.c_content')
                    ->group('l.id')
                    ->order('l.create_time','DESC')
                    ->paginate($limit)
                    ->toArray();
            }
            else {
                $list = db('claim')
                    ->alias('c')
                    ->join('lost l', 'c.lost_id=l.id', 'right')
                    ->where('c.c_status', 0)
                    ->field('l.id,l.thing,l.name,l.create_time,l.address,c.c_name')
                    ->group('l.id')
                    ->order('l.create_time','DESC')
                    ->paginate($limit)
                    ->toArray();
            }
            $list = $this->tableFormat($list);
            return $this->showList($list);
        }
        else
        {
            $list = db('lost_type')->select();
            $this->assign('list', $list);
            return $this->fetch();
        }
    }

    //点击认领按钮
    public function claimform()
    {
        if (request()->isPost())
        {
            $data = input('post.');
            $data['lost_id'] = $data['id'];
            unset($data['id']);
            db('claim')->insert($data);
            return $this->success('添加成功！等待审核', 'index');
        }
        else {
            $id = input('param.id');
            $info = null;
            if ($id) {
                $info = db('lost')->where('id',$id)->find();
            }
            $this->assign('info', json_encode($info, true));
            return $this->fetch('claimform');
        }
    }

    //同意认领
    public function agree()
    {
        if (request()->isPost()) {
            /*$data = input('post.id');
            db('claim')->where('lost_id',$data)->update(['c_status'=>'1']);
            return $this->success('同意这条申请','index');*/
        }
        else {
            $id= input('param.id');
            $add_result = db('lost')
                ->alias('l')
                ->where('l.id',(int)$id)
                ->update(['status'=>'1']);
            if($add_result)
                return $this->success('同意成功','claimindex');
            else
                return $this->success('已经同意','claimindex');
        }
    }

    //拒绝认领
    public function refuse()
    {
        if (request()->isPost()) {
            $data = input('post.id');
            db('claim')->where('lost_id',$data)->update(['c_status'=>'1']);
            return $this->success('不同意这条申请','index');
        }
        else {
            $id = input('param.id');
            $info = null;
            if ($id)
            {
                $info = db('lost')->where('id=' . $id)->find();
            }
            $this->assign('info', json_encode($info, true));
            return $this->fetch('claimform');
        }
    }

    //tableFormat
    protected function tableFormat($list)
    {
        foreach ($list['data'] as $k => $v) {
            if ($v['create_time']) {
                $list['data'][$k]['create_time'] = getTime($v['create_time']);
            }
        }
        return $list;
    }

    //时间，可见，置顶
    protected function dataFormat($data)
    {
        if ($data['create_time']) {//时间
            $data['create_time'] = getTime($data['create_time']);
        }
        /*//由于插件原因，必须将整形数转换为字符串型前台的form.val函数才能将单选初始化
        if ($data['visible']) {//可见
            $data["visible"] = strval($data["visible"]);
        }
        if ($data['top']) {//置顶
            $data["top"] = strval($data["top"]);
        }*/
        return $data;
    }

    //删除
    public function lostDel()
    {
        db('lost')->delete(input('post.id'));
        return $this->success('删除成功!');
    }

    //删除多项
    public function lostDelall()
    {
        $where = array('id' => array('in', explode(',', input('post.id'))));
        db('lost')->where($where)->delete();
        return $this->success('删除成功!');
    }

    //类别管理
    public function type()
    {
        if (request()->isPost()) {
            $list = db('lost_type')->alias('t')
                ->group('t.id')
                ->select();
            return $this->show($list);
        }
        return $this->fetch();
    }
    //类别编辑
    public function typeEdit()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if ($data['id'] == null) {
                $data['id']=session('id');
                db('lost_type')->insert($data);
                return $this->success('类别添加成功！', 'type');
            } else {
                db('lost_type')->update($data);
                return $this->success('类别编辑成功！', 'type');
            }
        } else {
            $id = input('param.id');
            $info = null;
            if ($id) {
                $info = db('lost_type')->where('id=' . $id)->find();
            }
            $this->assign('info', json_encode($info, true));
            return $this->fetch('type_form');
        }
    }
    //类别删除
    public function typeDel()
    {
        db('lost_type')->delete(input('post.id'));
        return $this->success('删除成功!');
    }

    public function view()
    {
        return $this->fetch();
    }
}
