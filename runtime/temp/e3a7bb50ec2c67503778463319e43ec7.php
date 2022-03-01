<?php /*a:1:{s:29:"F:\sheep\view\public\msg.html";i:1645890679;}*/ ?>
<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>错误页面 - 光年(Light Year Admin V4)后台管理系统模板</title>
  <link rel="icon" href="favicon.ico" type="image/ico">
  <meta name="keywords" content="LightYear,LightYearAdmin,光年,后台模板,后台管理系统,光年HTML模板">
  <meta name="description" content="Light Year Admin V4是一个后台管理系统的HTML模板，基于Bootstrap v4.4.1。">
  <meta name="author" content="yinqi">
  <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="/admin/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="/admin/css/style.min.css" rel="stylesheet">
  <style>
    .error-page {
      height: 100%;
      position: fixed;
      width: 100%;
    }

    .error-body {
      padding-top: 5%;
    }

    .error-body h1 {
      font-size: 210px;
      font-weight: 700;
      text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #868e96;
      line-height: 210px;
      color: #868e96;
    }
  </style>
</head>

<body>
  <div class="card text-center  <?php echo $code=='200' ? 'border-success text-success'  :  'border-danger text-danger'; ?>" style="width: 18rem; margin: 18rem auto;">
    <div class="card-header">
      系统提示
    </div>
    <div class="card-body">
      <h5 class="card-title"><?php echo htmlentities($code); ?></h5>
      <p class="card-text"><?php echo htmlentities($msg); ?></p>
      <a href="<?php echo htmlentities($url); ?>" class="btn btn-primary">返回</a>
    </div>
  </div>
  <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>

</body>

</html>