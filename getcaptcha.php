<?php

include_once "curl_post/curl_post.php";

$xxx = vlogin("http://202.118.201.228/academic/common/security/login.jsp","");
$x = vlogin("http://202.118.201.228/academic/getCaptcha.do","");
header('Content-type: image/jpg');
echo $x;
 ?>
