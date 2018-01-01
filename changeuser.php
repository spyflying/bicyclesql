<?php
require_once 'public.php';

$uid = $_POST["uid"];
$name = $_POST["uname"];
$pwd = $_POST["upss"];
$prof = $_POST["uprof"];
$paypss = $_POST["paypssw"];
$balance = $_POST["balance"];

echo "enter";
//判断是否已存在该用户
$uid_query = "SELECT *
              FROM user
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)){
	$uid_query = "UPDATE user
                SET username = '{$name}'
                WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
  	$uid_query = "UPDATE user
                SET userpss = '{$pwd}'
                WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
  	$uid_query = "UPDATE user
                SET userprof = '{$prof}'
                WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
 	$uid_query = "UPDATE account
                SET balance = '{$balance}'
                WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
    $uid_query = "UPDATE account
                SET paypssw = '{$paypss}'
                WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
    header("refresh:3;url=manager.html");
    print('修改成功~~~');
}
else{
	header("refresh:3; url = manager.html");
	print("不存在该用户，修改失败。。。。。。。。。");
}
  
  