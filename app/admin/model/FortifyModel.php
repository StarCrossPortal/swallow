<?php

namespace app\admin\model;

use think\facade\Db;
use think\Model;

class FortifyModel extends Model
{
    protected $name = 'fortify';


    public static function getCount(string $domain, int $projectId)
    {
        $data = [];
        $where = [ ['project_id', '=', $projectId]];

        $data['全部'] = Db::table('fortify')->where($where)->count();
        $data['严重'] = Db::table('fortify')->where($where)->where(['Folder' => 'Critical'])->cache(60)->count();
        $data['高危'] = Db::table('fortify')->where($where)->where(['Folder' => 'High'])->cache(60)->count();
        $data['中危'] = Db::table('fortify')->where($where)->where(['Folder' => 'Medium'])->cache(60)->count();
        $data['低危'] = Db::table('fortify')->where($where)->where(['Folder' => 'Low'])->cache(60)->count();

        return $data;
    }

    public static function getDetailCount()
    {

        $where = ['project_id' => 1];

        //修复率
        $repairNum = Db::table('fortify')->where($where)->where(['is_repair' => 1])->count();
        $unRepairNum = Db::table('fortify')->where($where)->count();
        $repairCount = (empty($repairNum) && empty($unRepairNum)) ? 0 : intval($repairNum / $unRepairNum);

        //漏洞等级
        $level1 = Db::table('fortify')->where($where)->where(['Folder' => 'Critical'])->count();
        $level2 = Db::table('fortify')->where($where)->where(['Folder' => 'High'])->count();
        $level3 = Db::table('fortify')->where($where)->where(['Folder' => 'Medium'])->count();
        $level4 = Db::table('fortify')->where($where)->where(['Folder' => 'Low'])->count();


        $countList = [
            ['name' => '漏洞总数(个)',
                'num' => Db::table('fortify')->where(['project_id' => 1])->count(),
                'lists' => [
                    '今日新增' => Db::table('fortify')->where($where)->whereTime('create_time', '>=', date('Y-m-d', time() - (7 * 86400)))->count(),
                    '本周新增' => Db::table('fortify')->where($where)->whereTime('create_time', '>=', date('Y-m-d', time() - (7 * 86400)))->count(),
                ]
            ],
            ['name' => '受影响仓库(个)', 'num' => Db::table('fortify')->where(['project_id' => 1])->group('git_addr')->count(),
                'lists' => [
                    '总数 ' => Db::table('fortify')->where(['project_id' => 1])->group('git_addr')->count(),
                    '7天新增 ' => Db::table('fortify')->whereTime('create_time', '>=', date('Y-m-d', time() - (7 * 86400)))->where(['project_id' => 1])->group('git_addr')->count()
                ]
            ],
            ['name' => '修复率', 'num' => $repairCount, 'lists' => ['待修复' => $unRepairNum, '已修复' => $repairNum]],
            ['name' => '严重漏洞(个)', 'num' => $level1,
                'lists' => [
                    '高危' => $level2,
                    '中危' => $level3,
                    '低危' => $level4,
                ]
            ],
        ];

        return $countList;
    }


}