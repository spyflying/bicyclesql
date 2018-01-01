<?php
//查询今天完成订单最多的用户
require_once 'public.php';

$areaname = $_POST["street"];

$mysql_query = "CREATE VIEW userarea AS(SELECT userid FROM record WHERE oriadd = '{$areaname}');";
//echo $mysql_query;

$result = mysqli_query($db, $mysql_query);
if(!$result){
	die('Cannot create view: ' . mysqli_error($db));
}

$mysql_query = "SELECT record.userid, sum(bill) AS totalmoney FROM record, userarea WHERE record.userid = userarea.userid GROUP BY userid;";
$result = mysqli_query($db, $mysql_query);
$arra = "";

while($row = mysqli_fetch_array($result)){
	//echo $row["userid"];
	$arra = $arra . $row["userid"] . ", " . (string)$row["totalmoney"] . "; ";
	//echo $arra;
}

echo $arra;

$mysql_query = "DROP VIEW userarea;";
$result = mysqli_query($db, $mysql_query);
?>
