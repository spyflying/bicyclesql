<?php
require_once "public.php";

$uid = $_GET["uid"];
mysqli_query($db, "set names 'utf8'");
$mysql_query = "SELECT recid, begintime, endtime, S.statname AS beginstat, B.statname AS endstat, bill
FROM record, station AS S, station AS B WHERE userid = '{$uid}' AND oriadd = S.posid AND endadd = B.posid;";
$result = mysqli_query($db, $mysql_query);
echo "显示全部订单";
echo "<br>";
echo "用户：";
echo $uid;
echo "<br>";
while($row = mysqli_fetch_array($result)){
	echo "订单号：";
  echo $row['recid'];
  echo " 开始时间：";
  echo $row['begintime'];
  echo " 结束时间：";
  echo $row['endtime'];
  echo " 开始地点：";
  echo $row['beginstat'];
  echo " 结束地点：";
  echo $row['endstat'];
  echo " 订单金额：";
  echo $row['bill'];
  echo "<br>";
}
 ?>
