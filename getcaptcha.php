<?php
include_once "curl_post/curl_post.php";

vlogin("http://202.118.201.228/academic/common/security/login.jsp","");
$data = vlogin("http://202.118.201.228/academic/getCaptcha.do","");
header('Content-type: image/jpg'); /* 图片类型 */
echo $data;
 ?>
