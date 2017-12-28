<?php
require_once "public.php";

$uid = $_POST["userid"];
$uname = $_POST["username"];
$uprof = $_POST["userprof"];

$uid_query = "UPDATE user
              SET username = '{$uname}'
              WHERE userid = '{$uid}';";
//echo $uid_query;

$result = mysqli_query($db, $uid_query);
if(!$result){
	die('Cannot update data: ' . mysqli_error($db));
}

$uid_query = "UPDATE user
              SET userprof = '{$uprof}'
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
if(!$result){
	die('Cannot update data: ' . mysqli_error($db));
}

//跳转到登录界面
header("refresh:3;url = login.html"); 
print("修改成功，三秒后跳转到登录页面。。。。。。");
?>
