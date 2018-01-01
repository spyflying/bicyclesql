<?php
//查询保修单车
require_once 'public.php';
mysqli_query($db, "set names 'utf8'");
$mysql_query = "SELECT bicid, statname FROM bicycle, station WHERE bicstat=2 AND bicadd = posid;";
//echo $mysql_query;

$result = mysqli_query($db, $mysql_query);
$arra = "";

while($row = mysqli_fetch_array($result)){
	//echo $row["userid"];
	$arra = $arra . $row["bicid"] . "号单车,位置：" . $row["statname"] . " ;----------";
	//echo "<br>";
	//echo $arra;
}

echo $arra;

?>
