<?php
require_once "public.php";
$bikeid = $_POST["bikeid"];
//检查是否存在
$bic_query = "SELECT *
              FROM bicycle
              WHERE bicid = '{$bikeid}';";

$result = mysqli_query($db, $bic_query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)){
    //存在单车
    $bic_query = "DELETE FROM bicycle WHERE bicid = '{$bikeid}';";
    $result = mysqli_query($db, $bic_query);
    //echo $bic_query;
    header("refresh:3; url = manager.html");
    print('成功删除~~~');
}
else{
	header("refresh:3; url = manager.html");
	print("不存在该单车，删除失败~~~");
}
?>

