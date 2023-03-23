<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\FortifyModel;
use think\facade\Db;
use think\facade\View;
use think\Request;

class Scan extends Common
{
    public function report(Request $request)
    {

        $countList = FortifyModel::getDetailCount();

        $where = ['project_id' => 1];

        if ($request->param('is_repair') !== null) $where['is_repair'] = $request->param('is_repair');
        if ($request->param('Folder') !== null) $where['Folder'] = $request->param('Folder');
        $list = Db::name('fortify')->where($where)->paginate([
            'list_rows' => 10,
            'var_page' => 'page',
        ]);
        $bugList['list'] = $list->items();
        $page = $list->render();

        foreach ($bugList['list'] as &$item) {
            $item['primary_info'] = json_decode($item['Primary'], true);
            $item['tags'] = [];
        }

        $data = [
            'countList' => $countList, 'bugList' => $bugList,
            'page' => $page, 'param' => $request->param()
        ];

        return View::fetch('report', $data);
    }

}
