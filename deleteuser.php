<?php
require_once "public.php";
$uid = $_POST["uid"];
//检查是否存在
$uid_query = "SELECT *
              FROM user
              WHERE userid = '{$uid}';";

$result = mysqli_query($db, $uid_query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)){
    //存在单车
    $uid_query = "DELETE FROM account WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
    $uid_query = "DELETE FROM user WHERE userid = '{$uid}';";
    $result = mysqli_query($db, $uid_query);
    //echo $bic_query;
    header("refresh:3; url = manager.html");
    print('成功删除~~~');
}
else{
	header("refresh:3; url = manager.html");
	print("不存在该用户，删除失败~~~");
}
?>
