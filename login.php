<?php
include_once "curl_post/curl_post.php";

$j_username = $_POST['j_username'];
$j_password = $_POST['j_password'];
$j_captcha = $_POST['j_captcha'];

#login
$data  = vlogin("http://202.118.201.228/academic/j_acegi_security_check","j_username=".$j_username."&j_password=".$j_password."&j_captcha=".$j_captcha);


//echo $data;

#$data = vlogin($post_url, $post_data);
#$data = vget("http://202.118.201.228/academic/index_new.jsp");

#handle
header("location: ./handle.php");

 ?>
