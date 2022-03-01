<?php
// 应用公共文件

/**
 * 资源路由生成(thinkPHP BUG)
 *
 * @param [type] $control
 * @param [type] $action
 * @return void
 */
function makeUrl($control, $action)
{
    $control = strtolower($control);
    $action = strtolower($action);
    if ($action == 'index') {
        return '/' . $control . '.html';
    } else {
        return url($control . '/' . $action);
    }
}

function jsonMsg($msg = '操作成功', $code = 200, $data = [])
{
    $res = [
        'msg'   =>  $msg,
        'data'  =>  $data,
        'code'  =>  $code
    ];
    return json($res);
}

function viewMsg($url = '/', $msg = '操作成功', $code = 200)
{
    $msg = [
        'msg'   =>  $msg,
        'code'  =>  $code,
        'url'   =>  $url
    ];
    return view('public/msg', $msg);
}
