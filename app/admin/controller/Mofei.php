<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\FortifyModel;
use app\admin\model\MofeiModel;
use think\facade\Db;
use think\facade\View;
use think\Request;

class Mofei extends Common
{
    public function index()
    {
        $countList = MofeiModel::getDetailCount();

        $where = ['project_id' => 1];
        $list = Db::name('murphysec')->where($where)->paginate([
            'list_rows' => 1,
            'var_page' => 'page',
        ]);
        $bugList['list'] = $list->items();
        $bugList['page'] = $list->render();

        foreach ($bugList['list'] as &$item) {
//            $item['extra'] = json_decode($item['extra'], true);
            $item['tags'] = [];
        }

        $data = ['countList' => $countList, 'bugList' => $bugList,'page'=>$bugList['page']];

        return View::fetch('index', $data);
    }
    public function vul_index()
    {
        $countList = MofeiModel::getDetailCount();

        $where = ['project_id' => 1];
        $list = Db::name('mf_vulns')->where($where)->paginate([
            'list_rows' => 1,
            'var_page' => 'page',
        ]);


        $bugList['list'] = $list->items();
        $bugList['page'] = $list->render();

        foreach ($bugList['list'] as &$item) {
//            $item['extra'] = json_decode($item['extra'], true);
            $item['tags'] = [];
        }

        $data = ['countList' => $countList, 'bugList' => $bugList,'page'=>$bugList['page']];

        return View::fetch('vul_index', $data);
    }
}
