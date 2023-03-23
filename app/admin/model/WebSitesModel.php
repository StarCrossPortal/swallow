<?php

namespace app\admin\model;

use think\facade\Db;
use think\Model;

class WebSitesModel extends Model
{
    protected $name = 'websites';


    public static function getCount($projectId)
    {
        $data = [];
        $cateList = Db::table('websites')->where(['project_id'=>$projectId])->group('port')->column('port');

        foreach ($cateList as $port) {
            $where = ['port' => $port,'project_id'=>$projectId];
            $data[$port] = Db::table('websites')->where($where)->cache(60)->count();
        }
        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByDomain($projectId)
    {
        $data = [];
        $cateList = Db::table('websites')->where(['project_id'=>$projectId])->group('domain')->column('domain');

        foreach ($cateList as $ip) {
            $where = ['domain' => $ip,'project_id'=>$projectId];
            $data[$ip] = Db::table('websites')->where($where)->cache(60)->count();
        }
        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByProtocol($projectId)
    {
        $data = [];
        $cateList = Db::table('websites')->where(['project_id'=>$projectId])->group('protocol')->column('protocol');

        foreach ($cateList as $protocol) {
            $where = ['protocol' => $protocol,'project_id'=>$projectId];
            $data[$protocol] = Db::table('websites')->where($where)->cache(60)->count();
        }
        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByPort($projectId)
    {
        $data = [];
        $cateList = Db::table('products')->whereNotIn('name', '')->group('name')->column('name');

        foreach ($cateList as $title) {
            $where = ['project_id' => $projectId];
            $data[$title] = Db::table('websites')->where($where)->whereLike('product', "%{$title}%")->cache(60)->count();
        }

        arsort($data);
        $data = array_filter($data);
        return $data;
    }

    public static function getCountByTitle($projectId)
    {
        $data = [];
        $cateList = Db::table('websites')->group('title')->column('title');

        foreach ($cateList as $title) {
            $where = ['project_id' => $projectId];
            $data[$title] = Db::table('websites')->where($where)->whereLike('title', $title)->cache(60)->count();
        }

        arsort($data);
        $data = array_filter($data);
        return $data;
    }
}