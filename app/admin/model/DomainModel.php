<?php

namespace app\admin\model;

use think\facade\Db;
use think\Model;

class DomainModel extends Model
{
    protected $name = 'domain';


    public static function getCount($domain, $projectId)
    {
        $where = ['project_id' => $projectId];
        $ipList = Db::table('ip')->where($where)->whereLike('domain', "%{$domain['domain']}%")->cache(60)->column('ip');

        $data =
            [
                '组织' => '',
                '备案' => Db::table('websites')->where($where)->whereNotNull('icp')->whereLike('domain', "%{$domain['domain']}%")->cache(60)->value('icp'),
                'DNS' => Db::table('domain')->where($where)->whereLike('domain', "%{$domain['domain']}%")->cache(60)->count(),
                '网站' => Db::table('websites')->where($where)->whereLike('domain', "%{$domain['domain']}%")->cache(60)->count(),
                'IP' => Db::table('ip')->where($where)->whereLike('domain', "%{$domain['domain']}%")->cache(60)->count(),
                '开放端口' => Db::table('ports')->where($where)->whereIn('ip', $ipList)->cache(60)->count(),
            ];
        return $data;
    }

    public static function setQingtingParams()
    {
        $where = ['project_id' => 1];
        $projectConf = Db::table('project_conf')->where($where)->column('value', 'key');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://qingting.starcross.cn/api/index/change_config?usce_id={$projectConf['QT_ID']}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query(json_decode($projectConf['QT_CONF'], true)),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "token: {$projectConf['QT_TOKEN']}"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }

    public static function setRunRule()
    {
        $where = ['project_id' => 1];
        $projectConf = Db::table('project_conf')->where($where)->column('value', 'key');

        $data = [
            'id' => $projectConf['QT_ID'],
            'time_value' => $projectConf['time_value'],
            'schedule' => $projectConf['schedule'],
            'cycle_start_time' => $projectConf['cycle_start_time']
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://qingting.starcross.cn/api/user_scenario/_edit",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "token: {$projectConf['QT_TOKEN']}"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        return $response;
    }
}