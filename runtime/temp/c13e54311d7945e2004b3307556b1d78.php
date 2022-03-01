<?php /*a:1:{s:29:"F:\sheep\view\power\edit.html";i:1645976818;}*/ ?>
<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>新增文档 - 光年(Light Year Admin V4)后台管理系统模板</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <meta name="keywords" content="LightYear,LightYearAdmin,光年,后台模板,后台管理系统,光年HTML模板">
  <meta name="description" content="Light Year Admin V4是一个后台管理系统的HTML模板，基于Bootstrap v4.4.1。">
  <meta name="author" content="yinqi">
  <link rel="stylesheet" type="text/css" href="/admin/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="/admin/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/admin/css/style.min.css">
</head>

<body>
  <div class="container-fluid p-t-15">

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="<?php echo url('power/'.$data['id']); ?>" method="post" class="form-group  ajax-form">
              <input type="hidden" name="__token__" value="<?php echo token(); ?>">
              <input type="hidden" name="_method"  value="put">
              <div class="form-group row">
                <label for="type" class="col-sm-2">栏目</label>
                <select name="pid" class="form-control col-sm-10" id="type">
                  <option value="0">顶级分类</option>
                  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo htmlentities($v['id']); ?>" <?php if(($data['pid'] == $v['id'])): ?>selected<?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-2">菜单名称</label>
                <input type="text" class="form-control col-sm-10" id="name" name="name" value="<?php echo htmlentities($data['name']); ?>" placeholder="请输入名称" />
              </div>
              <div class="form-group row">
                <label for="control" class="col-sm-2">控制器</label>
                <input type="text" class="form-control col-sm-10" id="control" name="control" value="<?php echo htmlentities($data['control']); ?>"
                  placeholder="请输入控制器名称" />
              </div>
              <div class="form-group row">
                <label for="action" class="col-sm-2">方法</label>
                <input type="text" class="form-control col-sm-10" id="action" name="action" value="<?php echo htmlentities($data['action']); ?>"
                  placeholder="请输入方法名称" />
              </div>
              <div class="form-group row">
                <label for="icon" class="col-sm-2">图标</label>
                <input type="text" class="form-control col-sm-10" id="icon" name="icon" value="<?php echo htmlentities($data['icon']); ?>"
                  placeholder="请输入图标代码" />
              </div>
              <div class="form-group row">
                <label for="url" class="col-sm-2">外部链接</label>
                <input type="text" class="form-control col-sm-10" id="url" name="url" value="<?php echo htmlentities($data['url']); ?>"
                  placeholder="请输入http开头的链接" />
              </div>
              <div class="form-group row">
                <label for="sort" class="col-sm-2">排序</label>
                <input type="text" class="form-control col-sm-10" id="sort" name="sort" value="<?php echo htmlentities($data['sort']); ?>" />
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-2">菜单显示</label>
                <div class="clearfix col-sm-10">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="statusOne" name="show" value="0" class="custom-control-input" <?php if(!$data['show']): ?>checked<?php endif; ?>>
                    <label class="custom-control-label" for="statusOne">隐藏</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="statusTwo" name="show" value="1" class="custom-control-input" <?php if($data['show']): ?>checked<?php endif; ?>>
                    <label class="custom-control-label" for="statusTwo">显示</label>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary ajax-post btn-block" target-form="add-form">确 定</button>
              </div>
            </form>

            <!-- <button class="btn btn-default reloadf">刷新</button> -->
          </div>
        </div>
      </div>

    </div>

  </div>
  <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/admin/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/admin/js/main.min.js"></script>
  <script type="text/javascript" src="/admin/js/lyear-loading.js"></script>

  <script>
    $(function () {

      //设置父级页面iframe显示高度
      $('.iframebox',window.parent.document).height($(document).height());

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
    })
  </script>
</body>

</html>