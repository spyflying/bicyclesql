<?php
require_once 'public.php';

$uid = $_POST['uid'];
$psw = $_POST['psw'];

$uid_query = "SELECT *
              FROM user
              WHERE userid = '{$uid}' and userpss = '{$psw}';";

/*$uid_query = "SELECT selled, uid 
              FROM Goods
              WHERE gid = '{$buying_gid}';";*/

$resultt = mysqli_query($db, $uid_query);
$result = $resultt->fetch_all(MYSQLI_ASSOC);

echo "用户名：". $result[0]['username'];
echo "<br>";

    $login_info = "";
    if (count($result) != 1) {
        $login_info = "昵称填写错误或密码填写错误！";
    } else {
        $_SESSION['userid']=$result[0]['userid'];
        $_SESSION['username']=$result[0]['username'];
        $_SESSION['userpss']=$result[0]['userpss'];
        $_SESSION['userprof']=$result[0]['userprof'];
        $_SESSION['usertype']=$result[0]['usertype'];
        $LocationRoleHref = "";
        switch($result[0]['usertype']) {
            case '0':
                $login_info = "您已经成功登录！您的角色是用户！";
                $LocationRoleHref = "index.php";
                break;
            case '1':
                $login_info = "您已经成功登录！您的角色是管理员！";
                $LocationRoleHref = "manager.php";
                break;
            default:break;
        }
    }
    echo '<br>';
    echo $login_info;
?>

<!DOCTYPE html>
<html>
<head>
    <title>操作选择</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>
 
<form action="select.php" method="post">
个人信息: <input type="text" name="userid">
<input type="submit" value="进入">
立即用车: <input type="text" name="bicycleid">
<input type="submit" value="提交">
</form>
 
</body>
</html>
