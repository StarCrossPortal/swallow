<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\model\DomainModel;
use app\admin\validate\ProjectConf;
use app\admin\validate\ProjectConfValidate;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Route;
use think\facade\View;
use think\Request;

class Project extends Common
{
    public function setting(Request $request)
    {

        $projectId = 1;
        $where = ['project_id' => $projectId];
        $projectConf = Db::table('project_conf')->where($where)->column('value', 'key');

        $mainList = Db::table('git_addr')->where($where)->select()->toArray();
        $data = ['mainList' => $mainList,   'projectConf' => $projectConf];
        View::assign($request->param());

        return View::fetch('setting', $data);
    }

    public function _add_domain(Request $request)
    {
        $domainStr = $request->param('domain');
        $domainArr = explode("\n", $domainStr);
        foreach ($domainArr as $domain) {
            $data = ['domain' => $domain, 'project_id' => 1];
            Db::table('domain')->extra('IGNORE')->insert($data);
            Db::table('git_addr')->extra('IGNORE')->insert($data);
        }


        return redirect($_SERVER['HTTP_REFERER']);
    }


    public function _del_domain(int $id)
    {
        Db::table('git_addr')->delete($id);


        return redirect($_SERVER['HTTP_REFERER']);
    }


    public function update_project_conf(Request $request)
    {

        $params = array_map('trim', $request->param());
        try {
            validate(ProjectConfValidate::class)->check($params);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            $this->error($e->getMessage());
        }


        foreach ($params as $key => $value) {
            $data = ['value' => $value, 'key' => $key, 'project_id' => 1];
            if ($data['key'] == 'cycle_start_time') $data['value'] = str_replace('T', ' ', $data['value']);
            Db::table('project_conf')->replace(true)->strict(false)->save($data);
        }

        //对接蜻蜓API
        $retUrl['paramRet'] = DomainModel::setQingtingParams();
        //修改周期运行时间
        $retUrl['ruleRet'] = DomainModel::setRunRule();

        return redirect((string)url("project/setting", $retUrl));
    }

}
