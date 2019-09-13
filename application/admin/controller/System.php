<?php

namespace app\Admin\controller;

use think\Controller;
use think\Db;

class System extends Base
{

    public function config()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $web  = [
                'web_name'    => $data['web_name'],
                'web_desc'    => $data['web_desc'],
                'smtp_server' => $data['smtp_server'],
                'smtp_port'   => $data['smtp_port'],
                'smtp_id'     => $data['smtp_id'],
                'smtp_user'   => $data['smtp_user'],
                'smtp_pwd'    => $data['smtp_pwd']
            ];
            $this->extraconfig($web, 'web');
            return $this->success('保存成功！');
        }
        return $this->fetch();
    }

    public function log()
    {
        if (request()->isPost()) {
            $limit = $this->request->post('limit', config('paginate.list_rows'), 'intval');
            $list = db('sys_log')->order('ctime desc')->paginate($limit)->toArray();
            return $this->showList($list);
        } else {
            return $this->fetch();
        }
    }

    public function logDelall()
    {
        $where = array('id' => array('in', explode(',', input('post.ids'))));
        db('sys_log')->where($where)->delete();
        return $this->success('删除成功!');
    }

    /**
     * 修改扩展配置文件
     * @param array $arr 需要更新或添加的配置
     * @param string $file 配置文件名(不需要后辍)
     * @return bool
     */
    function extraconfig($arr = [], $file = 'web')
    {
        if (is_array($arr)) {
            $filename = $file . EXT;

            $filepath = APP_PATH . 'extra/' . $filename;
            if (!file_exists($filepath)) {
                $conf = "<?php return [];";
                file_put_contents($filepath, $conf);
            }

            $conf = include $filepath;
            foreach ($arr as $key => $value) {
                $conf[$key] = $value;
            }

            $time = date('Y/m/d H:i:s');
            $str  = "<?php\r\n/**\r\n * 由extraconfig建立.\r\n * $time\r\n */\r\nreturn [\r\n";
            foreach ($conf as $key => $value) {
                $str .= "\t'$key' => '$value',";
                $str .= "\r\n";
            }
            $str .= '];';

            file_put_contents($filepath, $str);

            return true;
        } else {
            return false;
        }
    }
}
