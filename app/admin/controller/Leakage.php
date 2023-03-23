<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use think\Request;

class Leakage extends Common
{
    public function index(Request $request)
    {
        $where = ['project_id' => 1];
        $totalNum = Db::table('info_leak')->where($where)->count();
        $mainList = Db::table('info_leak')->where($where)->select()->toArray();
        foreach ($mainList as &$item) {
            $item['tags'] = json_decode($item['tags'], true);
        }
        $data = ['mainList' => $mainList,'totalNum'=>$totalNum];

        return View::fetch('index', $data);
    }
}
