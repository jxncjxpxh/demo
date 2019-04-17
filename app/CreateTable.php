<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/17
 * Time: 15:39
 * 创建分表分区接口
 * /createtable?type=1 当月表
 * /CreateTable 下个月表
 */

namespace app;

use lib\db\Mysql;

class CreateTable
{
    public $db;
    function __construct()
    {
        $this->db = new Mysql();

    }

    function index()
    {
        set_time_limit(0);
        $dir = ROOT_PATH . DIRECTORY_SEPARATOR . 'resource' . DIRECTORY_SEPARATOR . 'sqlfile';

        $createtype = isset($_GET['type'])?$_GET['type']:0;
        // echo $createtype;exit;
        if($createtype == 1)
        {
            $tablename_tail = date("Ym");
            $start_date = date('Ym01');
            $end_date = date('Ym01', strtotime("+1 month"));
        }
        else
        {
            $tablename_tail = date("Ym",strtotime("+1 month"));
            $start_date = date('Ym01', strtotime("+1 month"));
            $end_date = date('Ym01', strtotime("+2 month"));
        }

        $filelist = opendir($dir);
        while ($file = readdir($filelist)) {
            if(is_file($dir.'/'.$file) && substr($file, -4)=='.sql')
            {
                $sql = file_get_contents($dir.'/'.$file);
                $sql = str_replace('--tablenamedate--', $tablename_tail, $sql);
                $r = $this->db->runSql($sql);
                if($r) {
                    echo $file.' success<br>';
                } else {
                    echo $file.' fail<br>';
                }
            }
        }
    }

    function get_partition_arr($start_date, $end_date)
    {
        $partition_arr = array();
        for ($i=$start_date; $i < $end_date; $i=date('Ymd', strtotime("$i +1 day"))) {
            //PARTITION p20170601 VALUES LESS THAN (20170602) ENGINE = InnoDB,
            $next_day = date('Ymd', strtotime("$i +1 day"));
            $partition_arr[] = "PARTITION p$i VALUES LESS THAN ($next_day) ENGINE = InnoDB";
        }
        return $partition_arr;
    }
}