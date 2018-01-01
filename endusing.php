<?php
require_once 'public.php';

$bikeid = $_SESSION['bicid'];
$uid = $_SESSION['userid'];
$paypssw =$_GET['paypssw'];
$posid =$_GET['posid'];
$stime=$_SESSION['stime'];
//echo "开始时间：";
//echo $stime;
$bikeprice=$_SESSION['bicprice'];

$account_query="SELECT *
                FROM account
                WHERE userid ='{$uid}';";
$resultt = mysqli_query($db, $account_query);
$result = $resultt->fetch_all(MYSQLI_ASSOC);

    $bike_info = "";
    $paybill="";//当前订单费用
    $LocationRoleHref = "";

    if (count($result)!=1) {
        $bike_info = "订单支付失败，请重新进行尝试";
        $LocationRoleHref = "endusing.html?bicid=".$bikeid."&uid=".$uid;
    } else {
        $_SESSION['userid']=$result[0]['userid'];
        $_SESSION['balance']=$result[0]['balance'];
        $_SESSION['lastpay']=$result[0]['paypssw'];
        $_SESSION['useradd']=$result[0]['useradd'];
        if($result[0]['paypssw']!= $paypssw) {
            echo "密码错误，请重新输入";
        }
        else {
          $etime= date('Y-m-d H:i:s');
          $hour=floor((strtotime($etime)-strtotime($stime))%86400/3600);
          $minute=floor((strtotime($etime)-strtotime($stime))%86400/60);
          $second=floor((strtotime($etime)-strtotime($stime))%86400%60);
          if($minute>0 or $second>0)
            $hour++;
          $totalmoney = $bikeprice * $hour;
          $cash =(float)($result[0]['balance']- $totalmoney);

          $account_update = "UPDATE account
                          SET balance = '{$cash}', lastpay=0
                          WHERE userid='{$uid}';";
          //echo $account_update;
          $result2 = mysqli_query($db, $account_update);

          $bike_update = "UPDATE bicycle
                          SET bicadd = '{$posid}', bicstat=0
                          WHERE bicid='{$bikeid}';";
          //echo $account_update;
          $result1 = mysqli_query($db, $bike_update);

          //生成订单；
          //$tmpcode = substr(md5(time()),0,10);
          $timestap=date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
          //$sql ="INSERT INTO record (userid, bicid, begintime, oriadd)
            //  VALUES('{$uid}','{$bikeid}','{$stime}','{$bicaddd}');";
          $sql="INSERT INTO record (recid, userid, bicid, begintime, endtime, oriadd, endadd, bill)
          VALUES ('{$timestap}', '{$uid}', '{$bikeid}', '{$stime}', '{$etime}', '{$_SESSION['bicadd']}', {$posid}, {$cash});";
          $insertresult = mysqli_query($db, $sql);
          if(!$insertresult){
            die('Cannot insert record: ' . mysqli_error($db));
          }
          //echo $insertresult;

          echo "支付成功";
          echo "<br>";
          echo "<br>";
          echo "总价格为：";
          echo $totalmoney;
          echo "元";
          $LocationRoleHref="getinfo.php?uid=".$uid;
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
    <title>订单支付</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>

  <script>
      setTimeout(function () {
          location.href = "<?=$LocationRoleHref?>";
      }, 5000);
  </script>

</body>
</html>
