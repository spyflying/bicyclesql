<?php
require_once 'public.php';

$bikeid = $_GET['bikeid'];
//$uid=$_get['uid'];
//$uid =$_POST['uid'];
$uid=$_SESSION['userid'];

//echo "用户名            ";
//echo $uname;

$bikeid_query = "SELECT *
              FROM bicycle
              WHERE bicid = '{$bikeid}';";


$resultt = mysqli_query($db, $bikeid_query);
$result = $resultt->fetch_all(MYSQLI_ASSOC);

/*echo "单车密码：". $result[0]['bicpss'];
echo "<br>";*/

    $bike_info = "";
    if (count($result) != 1) {
        $bike_info = "单车编号不存在，请确认后重新输入";
        $LocationRoleHref = "userbike.html?uid=".$uid;
    } else {
        $_SESSION['bicid']=$result[0]['bicid'];
        $_SESSION['bicprice']=$result[0]['bicprice'];
        $_SESSION['bicpss']=$result[0]['bicpss'];
        $_SESSION['bicadd']=$result[0]['bicadd'];
        $_SESSION['bicstat']=$result[0]['bicstat'];
        $LocationRoleHref = "";
        switch($result[0]['bicstat']) {
            case '0':
                $bike_info= "单车密码：". $result[0]['bicpss'];
                date_default_timezone_set("Asia/Beijing");
                $stime= date('Y-m-d H:i:s');
                session_start();
                $_SESSION['stime']=$stime;
                $LocationRoleHref = "usingbike.php?bicid=".$_SESSION['bicid']."&uid=".$uid;
                break;
            case '1':
                $bike_info = "该单车正在使用中，请重新选择单车！";
                unset($_SESSION);
                $LocationRoleHref = "userbike.html?uid=".$uid;
                break;
            case '2':
                $bike_info = "单车正在维修中，请换其他单车使用！";
                unset($_SESSION);
                $LocationRoleHref = "userbike.html?uid=".$uid;
                break;
            default:break;
        }
    }
    echo '<br>';
    echo $bike_info;
    echo '<br>';
    echo '<br>';
?>

<!DOCTYPE html>
<html>
<head>
    <title>用车</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>

    <script>
        setTimeout(function () {
            location.href = "<?=$LocationRoleHref?>";
        }, 5000);
    </script>
</div>
</body>
</html>
