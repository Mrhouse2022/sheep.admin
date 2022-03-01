<?php /*a:1:{s:29:"F:\sheep\view\role\index.html";i:1646061991;}*/ ?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>文档列表 - 光年(Light Year Admin V4)后台管理系统模板</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="LightYear,LightYearAdmin,光年,后台模板,后台管理系统,光年HTML模板">
    <meta name="description" content="Light Year Admin V4是一个后台管理系统的HTML模板基于Bootstrap v4.4.1。">
    <meta name="author" content="yinqi">
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/admin/js/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <link href="/admin/css/animate.min.css" rel="stylesheet">
    <link href="/admin/css/style.min.css" rel="stylesheet">
    <style>
        .children {
            display: none;
        }

        .iframebox iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-toolbar d-flex flex-column flex-md-row">
                        <div class="toolbar-btn-action">
                            <a class="btn btn-primary m-r-5" onclick="openBox('添加菜单','<?php echo url('role/create'); ?>',)"><i
                                    class="mdi mdi-plus"></i>新增</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">编号</th>
                                        <th>名称</th>
                                        <th class="text-center">状态</th>
                                        <th class="text-center">添加时间</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td class="text-center"><?php echo htmlentities($v['id']); ?></td>
                                        <td><?php echo htmlentities($v['name']); ?></td>
                                        <td class="text-center">
                                            <?php if($v['status']): ?>
                                            <font class="text-success">正常</font>
                                            <?php else: ?>
                                            <font class="text-danger">停用</font>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo htmlentities($v['create_time']); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default ajax-think" href="javascript:void(0)"
                                                    onclick="openBox('编辑','<?php echo url('/role/'.$v['id'].'/edit'); ?>',)"
                                                    title="" data-toggle="tooltip" data-method="put"
                                                    data-original-title="编辑"><i class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default ajax-post confirm"
                                                    href="<?php echo url('role/' . $v['id']); ?>" title="" data-toggle="tooltip"
                                                    data-method="delete" data-original-title="删除"><i
                                                        class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/js/popper.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin/js/lyear-loading.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="/admin/js/jquery-confirm/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="/admin/js/main.min.js"></script>
    <script type="text/javascript">
        function openBox(title = '标题', url, width = '800px', height = '100px') {
            $.dialog({
                //标题
                title: title,
                boxWidth: width,
                useBootstrap: false,
                content: '<div style="height:' + height + '" class="iframebox"><iframe src="' + url + '" frameborder="0"></iframe></div>',
            });
        };
        $(function () {
            //tree
            $('.children-plus').click(function (e) {
                let id = e.target.dataset.id;
                let data = $('.children-plus-' + id).children('span').children('i');
                if ($('.f-' + id).is(':hidden')) {
                    $('.f-' + id).show();
                    data.removeClass().addClass('mdi mdi-minus');
                } else {
                    $('.f-' + id).hide();
                    data.removeClass().addClass('mdi mdi-plus');
                }
            });

            //thinkphp 请求
            $('.ajax-post').click(function () {
                var self = $(this), tips = self.data('tips'), ajax_url = self.attr("href") || self.data("url"), method = self.data('method');
                $.confirm({
                    title: '提示',
                    content: '删除后不可恢复,确定要删除吗?',
                    buttons: {
                        '确认': {
                            btnClass: 'btn-blue',
                            action: function () {
                                if (method) {
                                    console.log(method)
                                    $.post(ajax_url, { _method: method }, function (res) {
                                        if (res.code == 200) {
                                            $.notify({
                                                message: res.msg,
                                            }, {
                                                type: "success",
                                                placement: {
                                                    align: "center"
                                                },
                                                delay: "100",
                                                allow_dismiss: false,
                                                onClose: function () {
                                                    location.reload();
                                                }
                                            });

                                        } else {
                                            //错误返回
                                            $.notify({
                                                message: res.msg,
                                            }, {
                                                type: "danger",
                                                placement: {
                                                    align: "center"
                                                }
                                            });

                                        }
                                    });

                                }
                            }
                        },
                        '取消': function () {

                        }
                    }
                });

                return false;
            });
        });
    </script>
</body>

</html>