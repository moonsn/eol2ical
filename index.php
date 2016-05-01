<!DOCTYPE html>
<?php
$fp = fopen("count.txt", "r+");
$count = (int)fgets($fp);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>清华版教务系统课表导出到日历 - moonsn</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <form class="form-signin" action="./login.php" role="form" method="post">
        <h2>导出教务在线的课表到日历^_^</h2><blockquote><p class="lead">累计导出<span class="label label-success "><?php echo $count;?></span>次</p></blockquote>
        <h2 class="form-signin-heading">教务在线 信息：</h2>
        <div class="input-group">
            <span class="input-group-addon">用户</span>
            <input type="text" name="j_username" class="form-control" placeholder="教务在线账号" value="1304010126" required autofocus>
        </div>
        <div class="input-group">
            <span class="input-group-addon"> 密码 </span>
            <input type="text" name="j_password" class="form-control" placeholder="密码" value="220807" required>
        </div>
        <br>
        <div class="form-group">
          <label>
            验证码：<img name="jcaptcha" id="jcaptcha" onclick="refresh_jcaptcha(this)"
                                 src="./get.php"
                                 alt="点击刷新验证码"
                                 title="点击刷新验证码"
                                 style="cursor:pointer;"/>
                            <script language="Javascript">
                                function refresh_jcaptcha(obj) {
                                    obj.src = "./getcaptcha.php?" + Math.random();
                                }
                            </script>
          </label>
          <label>
            如果验证码没有显示，请点击图片获取验证码。
          </label>
        <input type="text" name="j_captcha" class="form-control" placeholder="验证码">

        </div>
        学年：
        <select class="form-control" name="year">
            <option value="2016">2016</option>
        </select>
        学期：
        <select class="form-control" name="term">
            <option value="1">春季</option>
            <option value="2">秋季</option>
        </select>
        <br/>
        <div class="alert alert-info" role="alert">
            你的教务在线信息只会使用一次，本程序不会记录你的任何信息，下次使用还需要教务在线信息，请放心使用。
            如果你遇到问题或者BUG，欢迎吐槽~moonsn1994@gmail.com
        </div>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">导出</button>
      </form>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<script>
iobj = document.getElementById("j_captcha");
refresh_jcaptcha(iobj);
</script>
