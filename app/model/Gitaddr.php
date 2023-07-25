<?php

namespace app\model;

use think\facade\Db;
use think\Model;


class Gitaddr extends Model
{

    public static function start()
    {
        self::autoDownTool();
        //读取上游数据
        $where = [];
        $list = Db::table('git_addr')->whereNull('code_path')->where($where)->select()->toArray();

        //处理数据
        foreach ($list as $val) {
            $codePath = self::execTool($val['git_addr']);
            $data = ['code_path' => $codePath];
            Db::table('git_addr')->where($val)->update($data);
        }
    }

    public static function execTool(string $gitAddr)
    {

        $path = parse_url($gitAddr, PHP_URL_PATH);
        $project_name = basename($path, ".git");

        $cmd = "cd /data/code && git clone --depth=1 {$gitAddr} $project_name";
        exec($cmd);

        return "/data/code/{$project_name}";
    }

    public static function autoDownTool()
    {
        $cmd = "which git";
        exec($cmd, $result);

        if (empty($result)) {
            $cmd = "git install git -y";
            echo $cmd . PHP_EOL;
            exec($cmd);
        }
    }
}