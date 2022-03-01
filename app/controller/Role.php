<?php

declare(strict_types=1);

namespace app\controller;

use app\common\PHPTree;
use app\model\AdminPower;
use app\model\AdminRole;
use app\model\AdminRule;
use app\validate\AdminRole as ValidateAdminRole;
use think\exception\ValidateException;
use think\Request;

class Role
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data   =   AdminRole::select();
        //var_dump($tree);
        return view('index', [
            'list'  =>  $data
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //权限页面列表
        $data = AdminPower::select();
        $data = PHPTree::makeTree($data);
        return view('create', [
            'list'  =>  $data
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        //try
        try {
            validate(ValidateAdminRole::class)->check($data);
        } catch (ValidateException $e) {
            return jsonMsg($e->getError(), 204);
        }
        $db   =   AdminRole::create($data);
        if (!$db) {
            return jsonMsg('添加失败', 204);
        }
        $rules = [];
        foreach ($data['rules'] as $key => $value) {
            $rules[$key]    =  [
                'power_id'  =>   $value,
                'role_id'   =>  $db['id'],
            ];
        }
        $rule  =   new AdminRule();
        $db2        =   $rule->saveAll($rules);
        if ($db2) {
            return jsonMsg();
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //权限页面列表
        $power = AdminPower::select();
        $power = PHPTree::makeTree($power);

        //角色已有权限
        $rule = AdminRule::where('role_id', $id)->field('power_id')->select();
        $arr = [];
        foreach ($rule as $key => $value) {
            $arr[]=$value['power_id'];
        }
        //角色信息
        $role = AdminRole::find($id);

        //return json($rule);
        return view('edit', [
            'list'  =>  $power,
            'data'  =>  $role,
            'rule'  =>  $arr
        ]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->param();
        //try
        try {
            validate(ValidateAdminRole::class)->check($data);
        } catch (ValidateException $e) {
            return jsonMsg($e->getError(), 204);
        }
        $db   =   AdminRole::update($data);
        if (!$db) {
            return jsonMsg('更新失败', 204);
        }
        //删除所有数据重新添加
        AdminRule::where('role_id',$id)->delete();
        $rules = [];
        foreach ($data['rules'] as $key => $value) {
            $rules[$key]    =  [
                'power_id'  =>   $value,
                'role_id'   =>  $id,
            ];
        }
        $rule  =   new AdminRule();
        $db2        =   $rule->saveAll($rules);
        if ($db2) {
            return jsonMsg();
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        AdminRole::destroy($id);
        AdminRule::where('role_id',$id)->delete();        
        return jsonMsg();
    }
}
