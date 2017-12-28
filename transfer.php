<?php
//每次只能提现10元，实在写不下去了+_+
require_once "public.php";

$uid = $_GET["uid"];

$uid_query = "SELECT *
              FROM account
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
while($row = mysqli_fetch_array($result)){
	if($row["balance"] <= 110){
		header("refresh:3;url = login.html"); 
    	print("余额不足，无法进行转出，三秒后跳转到登录页面。。。。。。");
	}
	else{
		$ubal = $row["balance"];
	}
}
$uid_query = "UPDATE account 
              SET balance = balance - 10
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
header("refresh:3;url = login.html"); 
print("成功提现10元，三秒后跳转到登录页面。。。。");
?>