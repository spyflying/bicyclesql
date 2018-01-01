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
$LocationRoleHref = "getinfo.php?uid=".$uid;
echo "修改信息完成";
?>

<!DOCTYPE html>
<html>
<head>
    <title>修改个人信息</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>

    <script>
        setTimeout(function () {
            location.href = "<?=$LocationRoleHref?>";
        }, 3000);
    </script>
</div>
</body>
</html>
