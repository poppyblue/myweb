<?php

namespace app\Admin\controller;

/**
 * 新闻
 */
class News extends Base
{

    public function index()
    {
        if (request()->isPost()) {
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

                $list = db('news')->alias('n')
                    ->join('news_type t', 'n.type_id = t.id', 'left')
                    ->field('n.*,t.type_name')
                    ->where($where)
                    ->order('create_time desc')
                    ->paginate($limit)
                    ->toArray();
                $list = $this->tableFormat($list);
                return $this->showList($list);
            }
        }else {
                $list = db('news_type')->select();
                $this->assign('list', $list);
                return $this->fetch();
            }
        }

        protected function tableFormat($list)
        {
            foreach ($list['data'] as $k => $v) {
                if ($v['create_time']) {
                    $list['data'][$k]['create_time'] = getTime($v['create_time']);
                }
            }
            return $list;
        }


        //设置新闻可见状态
        public function newsVisible()
        {
            $id = input('post.id');
            $visible = input('post.visible');
            if (db('news')->where('id=' . $id)->update(['visible' => $visible]) !== false) {
                return $this->success('设置成功!');
            } else {
                return $this->error('设置失败!');
            }
        }


        //设置新闻至顶状态
        public function newsTop()
        {
            $id = input('post.id');
            $top = input('post.top');
            if (db('news')->where('id=' . $id)->update(['top' => $top]) !== false) {
                return $this->success('设置成功!');
            } else {
                return $this->error('设置失败!');
            }
        }


        //新闻编辑
        public function edit()
{
    if (request()->isPost()) {
        $data = input('post.');
        $data['create_time'] = strtotime($data['create_time']);
        if ($data['id'] == null) {
            $data['user_id'] = session('userid');
            db('news')->insert($data);
            return $this->success('新闻添加成功！', 'index');
        } else {
            db('news')->update($data);
            return $this->success('新闻编辑成功！', 'index');
        }
    } else {
        $id = input('param.id');
        $info = null;
        if ($id) {
            $info = db('news')->where('id=' . $id)->find();
        }
        $this->assign("content", $info["content"]);
        $this->assign('info', json_encode($this->dataFormat($info), true));

        $news_type = db('news_type')->select();
        $this->assign('list', $news_type);

        return $this->fetch('news_form');
    }
}

        protected function dataFormat($data)
        {
            if ($data['create_time']) {
                $data['create_time'] = getTime($data['create_time']);
            }

            //由于插件原因，必须将整形数转换为字符串型前台的form.val函数才能将单选初始化
            if ($data['visible']) {
                $data["visible"] = strval($data["visible"]);
            }
            if ($data['top']) {
                $data["top"] = strval($data["top"]);
            }

            return $data;
        }


        //编辑器上传图片，用于wangeditor
        public function edtiorUpload()
        {
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move('./uploads/');
            $data = [];  //定义一个返回的数组
            if ($info) {
                $savename = $info->getSaveName();
                $savename = str_replace('\\', '/', $savename);
                $data['code'] = 0;
                $data['data'] = '/uploads/' . $savename;
            } else {
                $data['code'] = 1;
                $data['data'] = $file->getError();
            }
            return json_encode($data, JSON_UNESCAPED_SLASHES);
        }

        public function newsDel()
        {
            db('news')->delete(input('post.id'));
            return $this->success('删除成功!');
        }

        public function newsDelall()
        {
            $where = array('id' => array('in', explode(',', input('post.ids'))));
            db('news')->where($where)->delete();
            return $this->success('删除成功!');
        }


        //类别管理
        public function type()
        {
            if (request()->isPost()) {
                $list = db('news_type')->alias('t')
                    ->join('news n', 't.id=n.type_id', 'left')
                    ->field('t.*,count(n.id) as num')
                    ->group('t.id')
                    ->select();
                return $this->show($list);
            }
            return $this->fetch();
        }

        public function typeEdit()
        {
            if (request()->isPost()) {
                $data = input('post.');
                if ($data['id'] == null) {
                    db('news_type')->insert($data);
                    return $this->success('新闻类别添加成功！', 'type');
                } else {
                    db('news_type')->update($data);
                    return $this->success('新闻类别编辑成功！', 'type');
                }
            } else {
                $id = input('param.id');
                $info = null;
                if ($id) {
                    $info = db('news_type')->where('id=' . $id)->find();
                }
                $this->assign('info', json_encode($info, true));

                return $this->fetch('type_form');
            }
        }

        public function typeDel()
        {
            db('news_type')->delete(input('post.id'));
            return $this->success('删除成功!');
        }

        public function view()
        {
            return $this->fetch();
        }

}
