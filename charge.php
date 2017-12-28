<?php
//每次只能充10元
require_once "public.php";

$uid = $_GET["uid"];

$uid_query = "UPDATE account 
              SET balance = balance + 10
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
header("refresh:3;url = login.html"); 
print("成功提现10元，三秒后跳转到登录页面。。。。");
?>