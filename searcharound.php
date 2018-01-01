<?php
require_once 'public.php';

$posid = $_POST['posid'];


$bikeid_query = "SELECT *
              FROM bicycle
              WHERE bicadd = '{$posid}';";


$resultt = mysqli_query($db, $bikeid_query);
$result = $resultt->fetch_all(MYSQLI_ASSOC);

echo "以下为周边可用的单车：";
echo "<br>" ;
echo "<br>";

    $bike_info = "";
    if (count($result) == 0) {
        $bike_info = "周围没有可用单车";
        echo $bike_info;
        $LocationRoleHref = "userbike.html";
    } else {
      $amount=count($result);
      for($i=0;$i<$amount;$i++)
      {
        $_SESSION['bicid']=$result[$i]['bicid'];
        $_SESSION['bicprice']=$result[$i]['bicprice'];
        $_SESSION['bicpss']=$result[$i]['bicpss'];
        $_SESSION['bicadd']=$result[$i]['bicadd'];
        $_SESSION['bicstat']=$result[$i]['bicstat'];
        if($_SESSION['bicstat']==0){
          $LocationRoleHref = "";
          echo $_SESSION['bicid'];
          echo '<br>';
        }
      }
      $LocationRoleHref = "userbike.html";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>周围可用单车</title>
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
