<?php
require "../util/db.php";

$username = $_POST['username'];
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$cpassword = $_['cpassword'];
$phone_num = $_['phone_num'];
$email = $_email['email'];

$regist_err = FALSE;
$err_msg = "";

if ($password != $cpassword) {
    echo outmsg(DIFF_PASSWD);
    $regist_err = TRUE;
} else {
    
}
?>