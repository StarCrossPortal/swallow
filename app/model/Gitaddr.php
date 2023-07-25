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
            self::execTool($val);
        }
    }

    public static function execTool(array $val)
    {
        $gitAddr = $val['git_addr'];

        $path = parse_url($gitAddr, PHP_URL_PATH);
        $project_name = basename($path, ".git");

        $cmd = "cd /data/code && git clone --depth=1 {$gitAddr} $project_name";
        exec($cmd);

        $codePath = "/data/code/{$project_name}";

        $data = ['code_path' => $codePath];
        Db::table('git_addr')->where($val)->update($data);

        return $codePath;
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