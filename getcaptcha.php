<?php
include_once "curl_post/curl_post.php";
$_SESSION['uid'] = $_GET['u'].'.txt';
if (($fp = fopen($_SESSION['uid'], 'w')) == FALSE) {
    echo "error on open file : " .$_SESSION['uid'];
}
fclose($fp);

vlogin("http://202.118.201.228/academic/common/security/login.jsp","", true);
$data = vlogin("http://202.118.201.228/academic/getCaptcha.do","", true);
header('Content-type: image/jpg');
echo $data;

 ?>
