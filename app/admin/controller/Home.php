<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\DomainModel;
use app\admin\model\PortsModel;
use app\admin\model\ProductCateModel;
use app\admin\model\ProductsModel;
use app\admin\model\UrlsModel;
use think\facade\Db;
use think\facade\View;
use think\Request;

class Home extends Common
{
    public function index(Request $request)
    {

        $bugList = Db::table('fortify')->field('Category,count(Category) as num')->group('Category')->select()->toArray();
        $bugList = array_column($bugList, 'num','Category');
        arsort($bugList);

        $compList = Db::table('mf_vulns')->field('git_addr,count(git_addr) as num')->group('git_addr')->select()->toArray();
        $compList = array_column($compList, 'num','git_addr');
        arsort($compList);


        $otherList = [
            ['title' => '风险类型', 'lists' =>$bugList],
            ['title' => '组件供应', 'lists' => []],
            ['title' => '项目风险', 'lists' => $compList],
            ['title' => '危险函数', 'lists' => []],
        ];

        $data = ['otherList' => $otherList];

        return View::fetch('index', $data);
    }
}