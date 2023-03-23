<?php

namespace app\admin\model;

use think\facade\Db;
use think\Model;

class PortsModel extends Model
{
    protected $name = 'ports';


    public static function getCount($projectId)
    {
        $data = [];
        $cateList = Db::table('ports')->where(['project_id'=>$projectId])->group('port')->column('port');

        foreach ($cateList as $port) {
            $where = ['port' => $port,'project_id'=>$projectId];
            $data[$port] = Db::table('ports')->where($where)->cache(60)->count();
        }
        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByIp($projectId)
    {
        $data = [];
        $cateList = Db::table('ports')->where(['project_id'=>$projectId])->group('ip')->column('ip');

        foreach ($cateList as $ip) {
            $where = ['ip' => $ip,'project_id'=>$projectId];
            $data[$ip] = Db::table('ports')->where($where)->cache(60)->count();
        }
        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByProtocol($projectId)
    {
        $data = [];
        $cateList = Db::table('ports')->where(['project_id'=>$projectId])->group('protocol')->column('protocol');

        foreach ($cateList as $protocol) {
            $where = ['protocol' => $protocol,'project_id'=>$projectId];
            $data[$protocol] = Db::table('ports')->where($where)->cache(60)->count();
        }
        arsort($data);
        $data = array_filter($data);
        return $data;
    }
}