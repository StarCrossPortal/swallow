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
        $categoryList = ProductCateModel::getCount(1);
        $imgList = [
            ['src' => 'http://qingting.starcross.cn/static/logo1.svg', 'num' => 10],
            ['src' => 'http://qingting.starcross.cn/favicon.ico', 'num' => 10],
            ['src' => 'https://demo.starcross.cn/favicon.ico', 'num' => 10],
            ['src' => 'https://bootstrapdoc.com/assets/img/bootstrap.svg', 'num' => 10],
            ['src' => 'https://fofa.info/favicon.ico', 'num' => 10],
        ];

        $otherList = [
            ['title' => '风险类型', 'lists' => ['sdfsd' => 1]],
            ['title' => '组件供应', 'lists' => ['thinkPHP' => 10]],
            ['title' => '项目风险', 'lists' => ['qingscan' => 1]],
            ['title' => '危险函数', 'lists' => ['exec' => 10]],
        ];

        $data = ['categoryList' => $categoryList, 'imgList' => $imgList, 'otherList' => $otherList];

        return View::fetch('index', $data);
    }
}