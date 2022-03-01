<?php
declare (strict_types = 1);

namespace app\controller;

use app\BaseController;
use app\common\PHPTree;
use app\model\AdminPower;

class Index extends BaseController
{
    public function index()
    {
        
        // $msg = [
        //     'msg'   =>  '操作成功',
        //     'code'  =>  '200',
        //     'url'   =>  '/'
        // ];
        // return view('public/msg',$msg );
        //echo url('Admin/Index');
        $data   =   AdminPower::where('show',1)->order('sort asc')->select();
        $tree   =   PHPTree::makeTree($data);
        //var_dump($tree);
        return view('index',[
            'list'  =>  $tree
        ]);
    }
}
