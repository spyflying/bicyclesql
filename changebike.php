<?php
require_once "public.php";

$bikeid = $_POST["bikeid"];
$bikepss = $_POST["bikepss"];
$bikepos = $_POST["bikepos"];
$bikeprice = $_POST["bikeprice"];

//检查是否存在
$bid_query = "SELECT *
              FROM bicycle
              WHERE bicid = '{$bikeid}';";

$result = mysqli_query($db, $bid_query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)){
  $bid_query = "UPDATE bicycle
                SET bicpss = '{$bikepss}'
                WHERE bicid = '{$bikeid}';";
  $result = mysqli_query($db, $bid_query);
  $bid_query = "UPDATE bicycle
                SET bicadd = '{$bikepos}'
                WHERE bicid = '{$bikeid}';";
  $result = mysqli_query($db, $bid_query);
  $bid_query = "UPDATE bicycle
                SET bicprice = '{$bikeprice}'
                WHERE bicid = '{$bikeid}';";
  $result = mysqli_query($db, $bid_query);
  $bid_query = "UPDATE bicycle
                SET bicstat = '{$bikestate}'
                WHERE bicid = '{$bikeid}';";
  $result = mysqli_query($db, $bid_query);
  header("refresh:3; url = manager.html");
    print('修改成功！'); }
else{
  header("refresh:3; url = manager.html");
  print("不存在该编号单车，添加修改失败~~~");
}
?>