<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\FortifyModel;
use app\admin\model\SemgrepModel;
use think\facade\Db;
use think\facade\View;
use think\Request;

class Semgrep extends Common
{
    public function index()
    {
        $countList = SemgrepModel::getDetailCount();

        $where = ['project_id' => 1];
        $list = Db::name('semgrep')->where($where)->paginate([
            'list_rows' => 10,
            'var_page' => 'page',
        ]);
        $bugList['list'] = $list->items();
        $page = $list->render();

        foreach ($bugList['list'] as &$item) {
            $item['extra'] = json_decode($item['extra'], true);
            $item['tags'] = [];
        }

        $data = ['countList' => $countList, 'bugList' => $bugList,'page'=>$page];

        return View::fetch('index', $data);
    }

}
