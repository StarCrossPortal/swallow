<?php

namespace app\admin\validate;

use think\Validate;

class ProjectConfValidate extends Validate
{
    protected $rule = [
//        'name'  =>  'require|max:25',
        'time_value' => ['number', 'between' => '0,1000'],
        'schedule' => 'number',
        'QT_ID' => 'number|length:4',
        'QT_TOKEN' => 'length:32',
        'cycle_start_time' => 'date',
        'QT_CONF' => ['require', 'regex' => '/^\{.*/'],
    ];

}