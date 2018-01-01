<?php
//查询故障单车比可用单车多的街区
require_once 'public.php';

$mysql_query = "SELECT okbicadd FROM brokenbikestat, okbikestat WHERE brokenbiccount > okbiccount AND brokenbiccadd = okbicadd;";
//echo $mysql_query;

$result = mysqli_query($db, $mysql_query);
$arra = "";

while($row = mysqli_fetch_array($result)){
	//echo $row["userid"];
	$arra = $arra . $row["okbicadd"] . ", ";
	//echo $arra;
}

echo $arra;

?>