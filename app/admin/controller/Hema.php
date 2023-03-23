<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\FortifyModel;
use app\admin\model\HemaModel;
use think\facade\Db;
use think\facade\View;
use think\Request;

class Hema extends Common
{
    public function index()
    {
        $countList = HemaModel::getDetailCount();

        $where = ['project_id' => 1];
        $list = Db::name('hema')->where($where)->paginate([
            'list_rows' => 10,
            'var_page' => 'page',
        ]);


        $bugList['list'] = $list->items();
        $page = $list->render();
        foreach ($bugList['list'] as &$item) {
            $item['tags'] = [];
        }

        $data = ['countList' => $countList, 'bugList' => $bugList, 'page' => $page];

        return View::fetch('index', $data);
    }

}