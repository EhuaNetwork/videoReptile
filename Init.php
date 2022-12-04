<?php


class Init
{
    public function __construct($caiji)
    {
        $this->caiji = $caiji;
        $this->pinyin = new Pinyin();
        $this->db = new Db();

    }

    public function go()
    {
        $db = $this->db;

        $lists = $db->table('caiji_725998')->limit(100000000)->where(['status' => 0])->select();
        foreach ($lists as $dat) {
            dump('采集：' . $dat['title']);
            $dat['caiji'] = $this->search($dat['title']);
            $db->table('caiji_725998')->limit(5)->where(['id' => $dat['id']])->update(['status' => 1]);
        }
        dd($lists);
    }

    /**
     * 关键词检索 抓取目标池数据
     * @param $key
     * @return array
     * @author: Ehua(ehua999@163.com)
     * @Time: 2022/12/3 17:01
     */
    public function search($key)
    {
        $caiji = $this->caiji;
        foreach ($caiji as $dat) {
            $temp = $dat::init($key);
            if ($temp)
                $r[$dat] = $temp;
        }
        return $r;
    }

}





