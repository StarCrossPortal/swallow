<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\mf_vulnsModel;
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
            'list_rows' => 10,
            'var_page' => 'page',
        ]);
        $bugList['list'] = $list->items();
        $bugList['page'] = $list->render();

        foreach ($bugList['list'] as &$item) {
//            $item['extra'] = json_decode($item['extra'], true);
            $item['tags'] = [];
        }

        $data = ['countList' => $countList, 'bugList' => $bugList, 'page' => $bugList['page']];

        return View::fetch('index', $data);
    }

    public function comp_detail(Request $request)
    {
        $id = $request->param('id');
        $where = ['project_id' => 1, 'id' => $id];
        $info = Db::table('murphysec')->where($where)->find();

        $where = ['project_id' => 1];
        $preId = Db::table('murphysec')->where($where)->where('id', '<', $id)->value('id');
        $nextId = Db::table('murphysec')->where($where)->where('id', '>', $id)->value('id');

        return View::fetch('comp_detail', ['info' => $info, 'preId' => $preId, 'nextId' => $nextId]);
    }

    public function vul_index()
    {
        $countList = MofeiModel::getDetailCount();

        $where = ['project_id' => 1];
        $list = Db::name('mf_vulns')->where($where)->paginate([
            'list_rows' => 10,
            'var_page' => 'page',
        ]);


        $bugList['list'] = $list->items();
        $bugList['page'] = $list->render();

        foreach ($bugList['list'] as &$item) {
//            $item['extra'] = json_decode($item['extra'], true);
            $item['tags'] = [];
        }

        $data = ['countList' => $countList, 'bugList' => $bugList, 'page' => $bugList['page']];

        return View::fetch('vul_index', $data);
    }

    public function detail(Request $request)
    {
        $id = $request->param('id');
        $where = ['project_id' => 1, 'id' => $id];
        $info = Db::table('mf_vulns')->where($where)->find();

        $where = ['project_id' => 1];
        $preId = Db::table('mf_vulns')->where($where)->where('id', '<', $id)->value('id');
        $nextId = Db::table('mf_vulns')->where($where)->where('id', '>', $id)->value('id');

        return View::fetch('detail', ['info' => $info, 'preId' => $preId, 'nextId' => $nextId]);
    }
}
