<?php

namespace app\admin\model;

use think\Model;

class User extends Model
{

    public function stat_login()
    {
        $field = 'DATE_FORMAT(from_unixtime(login_time),"%Y-%m-%d") as day, count(*) as nums';

        $res = $this->field($field)->where("TIMESTAMPDIFF(DAY,from_unixtime(login_time),now()) <7")->group('DATE_FORMAT(from_unixtime(login_time),"%Y-%m-%d")')->select();

        $data = $this->get_lately_days(7, $res);
        return ['day' => $data['day'], 'data' => $data['data']];
    }

    public function stat_reg()
    {
        $field = 'DATE_FORMAT(from_unixtime(reg_time),"%Y-%m-%d") as day, count(*) as nums';

        $res = $this->field($field)->where("TIMESTAMPDIFF(DAY,from_unixtime(reg_time),now()) <7")->group('DATE_FORMAT(from_unixtime(reg_time),"%Y-%m-%d")')->select();

        $data = $this->get_lately_days(7, $res);
        return ['day' => $data['day'], 'data' => $data['data']];
    }

    /**
     * 获取最近天数的日期和数据
     * @param $day
     * @param $data
     * @return array
     */
    function get_lately_days($day, $data)
    {
        $day = $day-1;
        $days = [];
        $d = [];
        for($i = $day; $i >= 0; $i --)
        {
            $d[] = date('d', strtotime('-'.$i.' day')).'日';
            $days[date('Y-m-d', strtotime('-'.$i.' day'))] = 0;
        }
        foreach($data as $v)
        {
            $days[$v['day']] = $v['nums'];
        }
        $new = [];
        foreach ($days as $v)
        {
            $new[] = $v;
        }
        return ['day' => $d, 'data' => $new];
    }
}