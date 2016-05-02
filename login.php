<?php
include_once "curl_post/curl_post.php";

$j_username = $_POST['j_username'];
$j_password = $_POST['j_password'];
$j_captcha = $_POST['j_captcha'];
#login
$data  = vlogin("http://202.118.201.228/academic/j_acegi_security_check","j_username=".$j_username."&j_password=".$j_password."&j_captcha=".$j_captcha);

#handle
header("location: ./handle.php?y=".$_POST['year']."&t=".$_POST['term']."&r=".$_POST['r']."&rt=".$_POST['rt']);

 ?>
