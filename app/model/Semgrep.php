<?php

namespace app\model;

use think\facade\Db;
use think\Model;


class Semgrep extends Model
{

    public static function start()
    {
        $obj = new Semgrep();
        $obj->autoDownTool();
        //读取上游数据
        $where = [];
        $list = Db::table('git_addr')->whereNotNull('code_path')->where($where)->select()->toArray();


        //处理数据
        foreach ($list as $item) {

            $ret = $obj->execTool($item);

            if (empty($ret)) {
                print_r("semgrep 扫描失败:{$item['code_path']}");
                continue;
            }
            Db::table('semgrep')->replace()->strict(false)->insertAll($ret);

            $data = ['semgrep_scan_time' => date('Y-m-d H:i:s')];
            Db::table('git_addr')->where(['id' => $item['id']])->update($data);
        }
    }

    function execTool(array $info)
    {
        $codePath = $info['code_path'];
        $hash = md5($codePath);
        $outFile = "/tmp/{$hash}.json";
        if (!file_exists($outFile)) {
            print_r("开始扫描|{$codePath}|{$outFile}");
            $cmd = "semgrep scan --config auto  --json -o {$outFile}";
            print_r($cmd);

            exec($cmd, $result);
            print_r($result);
        }
        if (!file_exists($outFile)) {
            print_r("没有找到扫描结果文件:{$outFile}");
            return [];
        }
        $temp = json_decode(file_get_contents($outFile), true);
        $list = $temp['results'] ?? [];

        foreach ($list as &$item) {
            $item['git_addr']  = $info['git_addr'];
            foreach ($list[0] as $key => $tmp) {
                if (!is_string($item[$key])) $item[$key] = json_encode($item[$key], 256);
            }
        }

        return $list;
    }

    function autoDownTool()
    {
        $cmd = "which semgrep";
        exec($cmd, $result);

        if (empty($result)) {
            $cmd = "pip install semgrep";
            echo $cmd . PHP_EOL;
            exec($cmd);
        }
    }
}