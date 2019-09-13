<?php

namespace app\admin\controller;


class Index extends Base
{
    public function index()
    {

        //$this->assign('menus',json_encode($menus,true));
        return $this->fetch();
    }

    public function menu()
    {
        //导航
        // 获取缓存数据
        /*$authRule = cache('authRule');
        if(!$authRule){
            $authRule = db('user_rule')->where('menustatus=1')->order('sort')->select();
            cache('authRule', $authRule, 3600);
        }*/
        $authRule = db('user_rule')->where('menu=1')->order('sort')->select();
        //声明数组
        $menus = array();
        foreach ($authRule as $key=>$val){
            $authRule[$key]['href'] = url($val['href']);
            if($val['pid']==0){
                if(session('userid')!=1){
                    if(in_array($val['id'],$this->adminRules)){
                        $menus[] = $val;
                    }
                }else{
                    $menus[] = $val;
                }
            }
        }
        foreach ($menus as $k=>$v){
            foreach ($authRule as $kk=>$vv){
                if($v['id']==$vv['pid']){
                    if(session('userid')!=1) {
                        if (in_array($vv['id'], $this->adminRules)) {
                            $menus[$k]['children'][] = $vv;
                        }
                    }else{
                        $menus[$k]['children'][] = $vv;
                    }
                }
            }
        }
        //$res=
        return json_encode($menus,true);
    }



    public function home()
    {
        $data=db('user')->field('count(*) as num')->where("FROM_UNIXTIME(login_time,'%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')")->count();
        $this->assign('login_num', $data);
        $data=db('user')->field('count(*) as num')->where("FROM_UNIXTIME(reg_time,'%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')")->count();
        $this->assign('reg_num', $data);
        $data=db('user')->field('count(*) as num')->count();
        $this->assign('num', $data);

        $data = db('news')->order('create_time desc')->paginate(5);
        $this->assign('data', $data);

        return $this->fetch();
    }

    //退出登陆
    public function logout(){
        session(null);
        $this->redirect('login/index');
    }

}
