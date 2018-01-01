<?php
require_once "public.php";

$bikeid = $_POST["bikeid"];
$bikepss = $_POST["bikepss"];
$bikepos = $_POST["bikepos"];
$bikeprice = $_POST["bikeprice"];
$bikestate = 0;

//检查是否存在
$bic_query = "SELECT *
              FROM bicycle
              WHERE bicid = '{$bikeid}';";

$result = mysqli_query($db, $bic_query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)){
    //存在单车
    header("refresh:3; url = manager.html");
    print('该编号单车已存在，添加失败~~~');
}
else{
	$bic_query = "INSERT INTO bicycle(bicid, bicprice, bicpss, bicadd, bicstat)
					VALUES('{$bikeid}', '{$bikeprice}', '{$bikepss}', '{$bikepos}', '{$bikestate}');";
	//echo $bic_query;
	$result = mysqli_query($db, $bic_query);
	if($result){
	header("refresh:3; url = manager.html");
    print('添加成功！');	
	}	
	else{
		print("添加失败");
	}
}
	

