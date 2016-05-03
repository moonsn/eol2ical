<?php session_start(); ?>
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
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">用户</span>
                    <input type="text" name="j_username" id="username" class="form-control" placeholder="教务在线账号" value="" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">密码</span>
                    <input type="password" name="j_password" class="form-control" placeholder="密码" value="" required>
                </div>
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
                        var username = document.getElementById('username').value;
                        if(username == '') {
                            alert('请先填写用户名，再获取验证码！');
                        }
                        obj.src = "./getcaptcha.php?t=" + Math.random() + "&u=" + username;
                    }
                    </script>
                </label>
                <label>
                </label>
                <input type="text" name="j_captcha" class="form-control" placeholder="验证码">

            </div>
            <div class="alert alert-error" role="alert">
                请先填写账号后再获取验证码。
            </div>
            <div class="form-group">
                学年：
                <select class="form-control" name="year">
                    <option value="2016">2016</option>
                </select>
                学期：
                <select class="form-control" name="term">
                    <option value="1">春季</option>
                    <option value="2">秋季</option>
                </select>
            </div>
            <br/>
            <div class="form-group">
                是否提前提醒:(分钟)
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="checkbox" name="r">
                    </span>
                    <input type="numbler" class="form-control" name="rt">
                </div>
            </div>
            <br/>
            <div class="alert alert-info" role="alert">
                你的教务在线信息只会使用一次，本程序不会记录你的任何信息，下次使用还需要教务在线信息，请放心使用。
                如果你遇到问题或者BUG，欢迎吐槽~moonsn1994@gmail.com
            </div>
            <br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit">导出</button>

        </form>
        <div class="form-signin">
            <div id="disqus_thread"></div>
<script>
/**
* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');

s.src = '//moonsn.disqus.com/embed.js';

s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
<script>
iobj = document.getElementById("j_captcha");
refresh_jcaptcha(iobj);
</script>
