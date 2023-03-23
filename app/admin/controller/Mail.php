<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use think\Request;

class Mail extends Common
{
    public function index(Request $request)
    {
        $where = ['project_id' => 1];
        $mailList = Db::table('mail')->where($where)->select()->toArray();
        foreach ($mailList as &$mail) {
            $mail['lists'] = Db::table('mail_url')->where($where)->where(['mail' => $mail['mail']])->select()->toArray();
        }

        $data = ['mailList' => $mailList];

        return View::fetch('index', $data);
    }
}
