<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\View;

class Common extends BaseController
{

    public function __construct()
    {

        $controName = \think\facade\Request::controller();
        $actionName = \think\facade\Request::action();

        $currentHref = strtolower("{$controName}/{$actionName}");

        $menuList = [
            ['title' => '概要', 'href' => 'home/index'],
            ['title' => '仓库列表', 'href' => 'git_addr/index'],
            ['title' => '漏洞管理', 'href' => 'scan/report'],
            ['title' => '危险函数', 'href' => 'semgrep/index'],
            ['title' => '依赖漏洞', 'href' => 'mofei/vul_index'],
            ['title' => '<span style="font-size:13px;">WebShell</span>', 'href' => 'hema/index', 'icon' => 'WebShell'],
            ['title' => '组件清单', 'href' => 'mofei/index'],
            ['title' => '设置', 'href' => 'project/setting'],
        ];
        $headImg = 'https://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83erTCOcE08e8ia72SSqabRHQJr43rRJ1s0Tam2gib9RdQUClVicKyGlibLc0AOuzhTI6qpqY74gVrgzsvA/132';
        View::assign('href', $currentHref);
        View::assign('menu_list', $menuList);
        View::assign('userInfo', ['headimgurl' => $headImg]);
    }


    protected function apiReturn($data = [], $status = 0, $msg = '', $isRaw = false)
    {
        if ($isRaw) {
            return json($data);
        }
        $result['code'] = $status;
        $result['msg'] = $msg;
        $result['data'] = $data;


        return json($result);
    }
}
