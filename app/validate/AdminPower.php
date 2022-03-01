<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class AdminPower extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        '__token__'  =>  'token',
        'name|菜单名称'  =>  'require|max:64',
        'sort|排序'  =>  'number|max:11',
        'url|链接'   =>  'url'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
