<?php

declare(strict_types=1);

namespace app\controller;

use app\common\PHPTree;
use app\model\AdminPower;
use app\validate\AdminPower as ValidateAdminPower;
use think\exception\ValidateException;
use think\Request;

class Power
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data   =   AdminPower::order('sort asc')->select();
        $tree   =   PHPTree::makeTree($data);
        //var_dump($tree);
        return view('index', [
            'list'  =>  $tree
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data   =   AdminPower::where('pid', 0)->select();
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
            validate(ValidateAdminPower::class)->check($data);
        } catch (ValidateException $e) {
            return jsonMsg($e->getError(), 204);
        }

        //写入数据
        $db   =   AdminPower::create($data);
        if ($db) {
            return jsonMsg();
        }
        return;
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        return 'read显示指定的资源';
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $topdata    =   AdminPower::where('pid', 0)->select();
        $data       =   AdminPower::find($id);
        //dump($data->toArray());
        return view('edit', [
            'list'  =>  $topdata,
            'data'  =>  $data,
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
            validate(ValidateAdminPower::class)->check($data);
        } catch (ValidateException $e) {
            return jsonMsg($e->getError(), 204);
        }

        //写入数据
        $db   =   AdminPower::update($data);
        if ($db) {
            return jsonMsg();
        }
        return;
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $data = AdminPower::destroy($id);
        if ($data) {
            return jsonMsg();
        } else {
            return jsonMsg('操作失败', '204');
        }
    }
}
