<?php
//查询单车低于平均单车的区域
require_once 'public.php';

mysqli_query($db, "set names 'utf8'");
$mysql_query = "SELECT statname FROM station, avgbic WHERE bicnum < (SELECT avg(bicnum) FROM avgbic) and posid = stationname ;";

$result = mysqli_query($db, $mysql_query);
$arr = "";

while($row = mysqli_fetch_array($result)){
	$arr = $arr . $row["statname"] . ", ";
}

echo $arr;

?>
