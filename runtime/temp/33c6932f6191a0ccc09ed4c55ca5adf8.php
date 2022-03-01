<?php /*a:1:{s:30:"F:\sheep\view\role\create.html";i:1646060316;}*/ ?>
<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>设置权限 - 光年(Light Year Admin V4)后台管理系统模板</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <meta name="keywords" content="LightYear,LightYearAdmin,光年,后台模板,后台管理系统,光年HTML模板">
  <meta name="description" content="Light Year Admin V4是一个后台管理系统的HTML模板，基于Bootstrap v4.4.1。">
  <meta name="author" content="yinqi">
  <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="/admin/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="/admin/css/style.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid p-t-15">

    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <form action="<?php echo url('role/save'); ?>" method="post" class="form-group ajax-form">
              <input type="hidden" name="__token__" value="<?php echo token(); ?>">
              <div class="form-group row">
                <label for="name" class="col-sm-2">角色名字</label>
                <input type="text" class="form-control col-sm-10" id="name" name="name" value=""
                  placeholder="请输入角色名字" />
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-2">状态</label>
                <div class="clearfix col-sm-10">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="statusOne" name="status" value="0" class="custom-control-input">
                    <label class="custom-control-label" for="statusOne">启用</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="statusTwo" name="status" value="1" class="custom-control-input" checked>
                    <label class="custom-control-label" for="statusTwo">停用</label>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="check-all">
                          <label class="custom-control-label" for="check-all">全选</label>
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                      <td class="p-l-20">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" name="rules[]"
                            class="custom-control-input checkbox-parent checkbox-child" id="roleid-<?php echo htmlentities($v['id']); ?>" dataid="id-<?php echo htmlentities($v['id']); ?>"
                            value="<?php echo htmlentities($v['id']); ?>">
                          <label class="custom-control-label" for="roleid-<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></label>
                        </div>
                      </td>
                    </tr>
                    
                    <?php if(!empty($v['children'])): ?>
                    <tr>
                      <td class="p-l-40">
                        <?php if(is_array($v['children']) || $v['children'] instanceof \think\Collection || $v['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vr): $mod = ($i % 2 );++$i;?>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" name="rules[]" class="custom-control-input checkbox-child"
                            id="roleid-<?php echo htmlentities($v['id']); ?>-<?php echo htmlentities($vr['id']); ?>" dataid="id-<?php echo htmlentities($v['id']); ?>-<?php echo htmlentities($vr['id']); ?>" value="<?php echo htmlentities($vr['id']); ?>">
                          <label class="custom-control-label" for="roleid-<?php echo htmlentities($v['id']); ?>-<?php echo htmlentities($vr['id']); ?>"><?php echo htmlentities($vr['name']); ?></label>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                      </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                  </tbody>
                </table>
              </div>
              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary ajax-post btn-block" target-form="add-form">确 定</button>
              </div>

            </form>

          </div>
        </div>
      </div>

    </div>

  </div>

  <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="/admin/js/popper.min.js"></script>
  <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/admin/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/admin/js/main.min.js"></script>
  <script type="text/javascript" src="/admin/js/chosen.jquery.min.js"></script>
  <script type="text/javascript" src="/admin/js/lyear-loading.js"></script>
  <script type="text/javascript">
    $(function () {

      //设置父级页面iframe显示高度
      $('.iframebox', window.parent.document).height($(document).height());

      //post提交
      $('.ajax-post').click(function (e) {

        var self = $(this), url = $('.ajax-form').attr('action'), data = $('.ajax-form').serialize(), L = self.lyearloading({
          opacity: 0.2,
          spinnerSize: 'nm'
        });
        //按钮禁用
        self.attr("disabled", true);

        $.ajax({
          //几个参数需要注意一下
          type: "POST",//方法类型
          dataType: "json",//预期服务器返回的数据类型
          url: url,//url
          data: data,
          success: function (res) {
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
                  window.parent.location.reload();
                }
              });

            } else {
              //错误返回
              self.attr("disabled", false);
              L.destroy();
              $.notify({
                message: res.msg,
              }, {
                type: "danger",
                placement: {
                  align: "center"
                }
              });

            }
          }
        });
        //禁止转跳
        event.preventDefault();
      });

      //动态选择框，上下级选中状态变化
      $('input.checkbox-parent').on('change', function () {
        var dataid = $(this).attr("dataid");
        $('input[dataid^=' + dataid + '-]').prop('checked', $(this).is(':checked'));
      });
      $('input.checkbox-child').on('change', function () {
        var dataid = $(this).attr("dataid");
        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
        var parent = $('input[dataid=' + dataid + ']');
        if ($(this).is(':checked')) {
          parent.prop('checked', true);
          //循环到顶级
          while (dataid.lastIndexOf("-") != 2) {
            dataid = dataid.substring(0, dataid.lastIndexOf("-"));
            parent = $('input[dataid=' + dataid + ']');
            parent.prop('checked', true);
          }
        } else {
          //父级
          if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
            parent.prop('checked', false);
            //循环到顶级
            while (dataid.lastIndexOf("-") != 2) {
              dataid = dataid.substring(0, dataid.lastIndexOf("-"));
              parent = $('input[dataid=' + dataid + ']');
              if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                parent.prop('checked', false);
              }
            }
          }
        }
      });
    });
  </script>
</body>

</html>