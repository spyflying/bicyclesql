<?php
//每次只能充10元
require_once "public.php";

$uid=$_SESSION['userid'];

$uid_query = "UPDATE account
              SET balance = balance + 10
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
$LocationRoleHref = "getinfo.php?uid=".$uid;
echo "成功充值10元";
?>

<!DOCTYPE html>
<html>
<head>
    <title>充值</title>
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
