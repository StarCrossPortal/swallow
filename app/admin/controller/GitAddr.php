<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use think\Request;

class GitAddr extends Common
{
    public function index(Request $request)
    {
        $where = ['project_id' => 1];
        $totalNum = Db::table('git_addr')->where($where)->count();


        $list = Db::name('git_addr')->where($where)->paginate([
            'list_rows' => 10,
            'var_page' => 'page',
        ]);
        $mainList = $list->items();
        $page = $list->render();

        foreach ($mainList as &$item) {
            $where['git_addr'] = $item['git_addr'];
            $item['fortify'] = Db::table('fortify')->where($where)->count();
            $item['semgrep'] = Db::table('semgrep')->where($where)->count();
            $item['mofei'] = Db::table('mf_vulns')->where($where)->count();
            $item['webshell'] = Db::table('hema')->where($where)->count();
        }

        $data = ['mainList' => $mainList, 'totalNum' => $totalNum, 'page' => $page];

        return View::fetch('index', $data);
    }

    public function _add(Request $request)
    {
        $gitAddr = $request->param('git_addr');
        $data = ['project_id' => 1];

        $gitAddrArr = explode("\n", $gitAddr);

        foreach ($gitAddrArr as $url) {
            $data['git_addr'] = trim($url);
            Db::table('git_addr')->strict(false)->extra('IGNORE')->insert($data);
        }

        return redirect($_SERVER['HTTP_REFERER']);

    }

    public function _del($id)
    {
        Db::table('git_addr')->delete($id);

        return redirect($_SERVER['HTTP_REFERER']);
    }
}
