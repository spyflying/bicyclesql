<?php
//查询今天完成订单最多的用户
require_once 'public.php';

$mysql_query = "SELECT userid FROM recordcount WHERE usernum=(SELECT max(usernum) FROM recordcount);";
//echo $mysql_query;

$result = mysqli_query($db, $mysql_query);
$arra = "";

while($row = mysqli_fetch_array($result)){
	//echo $row["userid"];
	$arra = $arra . $row["userid"] . ", ";
	//echo $arra;
}

echo $arra;

?>