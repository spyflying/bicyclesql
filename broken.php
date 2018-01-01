<?php
require_once 'public.php';
    $uid = $_SESSION['userid'];
    $bikeid = $_SESSION['bicid'];
    $bikestat_update = "UPDATE bicycle
                  SET bicstat = 2
                  WHERE bicid='{$bikeid}';";
    $result4 = mysqli_query($db, $bikestat_update);
    echo "您将";
    echo $bikeid;
    echo "号单车报修";
    echo "<br>";
    echo "感谢对我们工作的支持！";
    echo "<br>";
    echo "请选择其他单车使用";
    unset($_SESSION);
    $_SESSION['userid']=$uid;
    $LocationRoleHref = "http://localhost/bike/bicyclesql-master/userbike.html?uid=".$uid;
?>
<!DOCTYPE html>
<html>
<head>
    <title>报修</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>
  <script>
        setInterval(function () {
            location.href = "<?=$LocationRoleHref?>";
          }, 3000);

  </script>
</body>
</html>
