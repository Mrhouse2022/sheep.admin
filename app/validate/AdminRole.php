<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class AdminRole extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        '__token__'     =>  'token',
        'name|角色名称' =>  'require|max:64',
        'rules|权限'    =>  'require',
        'status'        =>  'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
