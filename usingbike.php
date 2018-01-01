<?php

require_once 'public.php';

$bikeid = $_SESSION['bicid'];
$uid = $_SESSION['userid'];
$stime=$_SESSION['stime'];

echo "当前订单记录";
echo "<br>";
echo "<br>";

$bike_update = "UPDATE bicycle
              SET bicstat = 1
              WHERE bicid='{$bikeid}';";
$result1 = mysqli_query($db, $bike_update);


$account_update = "UPDATE account
                SET lastpay = 1
                WHERE userid='{$uid}';";
//echo $account_update;
$result2 = mysqli_query($db, $account_update);

$bikeid_query = "SELECT *
              FROM bicycle
              WHERE bicid = '{$bikeid}';";
$resultt = mysqli_query($db, $bikeid_query);
$result = $resultt->fetch_all(MYSQLI_ASSOC);

    if(!$result1){
    	die('Cannot update bicycle data: ' . mysqli_error($db));
    }else if(!$result2){
    	die('Cannot update account data: ' . mysqli_error($db));
    }
    else {
      if (count($result) != 1) {
          die('Cannot find bicycle data: ' . mysqli_error($db));
      } else {
          $_SESSION['bicid']=$result[0]['bicid'];
          $_SESSION['bicprice']=$result[0]['bicprice'];
          $_SESSION['bicpss']=$result[0]['bicpss'];
          $_SESSION['bicadd']=$result[0]['bicadd'];
          $_SESSION['bicstat']=$result[0]['bicstat'];
          $address_query = "SELECT *
                        FROM station
                        WHERE posid = '{$_SESSION['bicadd']}';";
          $resultt = mysqli_query($db, $address_query);
          $result3 = $resultt->fetch_all(MYSQLI_ASSOC);
          $_SESSION['address']=$result3[0]['statname'];

          //生成订单；
          //$tmpcode = substr(md5(time()),0,10);
        /*  $timestap=date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
          //$sql ="INSERT INTO record (userid, bicid, begintime, oriadd)
            //  VALUES('{$uid}','{$bikeid}','{$stime}','{$bicaddd}');";
          $sql="INSERT INTO record (recid, userid, bicid, begintime, endtime, oriadd, endadd, bill)
          VALUES ('{$timestap}', '{$uid}', '{$bikeid}', '{$stime}', NULL, '{$_SESSION['bicadd']}', NULL, NULL);";
          echo $sql;
          echo "hhh";
          $insertresult = mysqli_query($db, $sql);
          if(!$insertresult){
            die('Cannot insert record: ' . mysqli_error($db));
          }
          //echo $insertresult;*/

          $LocationRoleHref = "";
          if($_SESSION['bicprice']=1.0){
            $rank="经济车";
          }
          else if($_SESSION['bicprice']=1.5){
            $rank="舒适车";
          }
          else {
            $rank="豪华车";
          }
          echo "当前使用的单车为：";
          echo $rank;
          echo "<br>";
          echo "<br>";
          echo "行程开始地址：";
          echo $_SESSION['address'];
          echo "<br>";
          echo "<br>";
          echo "行程开始时间：";
          echo $stime;
          echo "<br>";
          echo "<br>";
          echo "累计使用时长：";
          $endtime =date('Y-m-d H:i:s');//获取程序执行结束的时间
          $hour=floor((strtotime($endtime)-strtotime($stime))%86400/3600);
          $minute=floor((strtotime($endtime)-strtotime($stime))%86400/60);
          $second=floor((strtotime($endtime)-strtotime($stime))%86400%60);
          echo $hour."小时";
          echo $minute."分钟";
          echo $second."秒";
          echo "<br>";
          echo "<br>";
          $LocationRoleHref = "usingbike.php?bicid=".$_SESSION['bicid']."&uid=".$uid;
        }
      }
?>

<!DOCTYPE html>
<html>
<head>
    <title>结束行程</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>

<script>
      function enduse(){
        alert("结算");
        var dis = "<?php
        $url = "http://localhost/bike/bicyclesql-master/endusing.html?uid=".$uid;
        echo $url;
        ?>";
        window.location.href = dis;
    }
    function broken(){
      alert("报修");
      var dis = "<?php
      $url = "http://localhost/bike/bicyclesql-master/broken.php?uid=".$uid;
      echo $url;
      ?>";
      window.location.href = dis;
  }
              setInterval(function () {
                  location.href = "<?=$LocationRoleHref?>";
              }, 1000);

</script>
    <input type="button" name="show" id="show" value="我要报修" onclick= "broken();">
  	<input type="button" name="show" id="show" value="结束用车" onclick= "enduse();">
</body>
</html>
