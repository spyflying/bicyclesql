<?php
require_once 'public.php';
$uid = $_GET["uid"];
//echo $uid;
$uid_query = "SELECT *
              FROM user NATURAL JOIN account
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
if(!$result)
{
    die('Cannot read data: ' . mysqli_error($conn));
}
//get user infomation
while($row = mysqli_fetch_array($result)){
	$uname = $row["username"];
	$uprof = $row["userprof"];
	$ubal = $row["balance"]-100;
  $lastpay=$row["lastpay"];
  $_SESSION['userid']=$uid;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf8">
	<title>显示个人信息</title>
</head>
<body>
	<h1>用户信息</h1>
	<p><?php echo "用户名            ";
	echo $uname;?></p>
	<p><?php
	echo "手机             ";
	echo $uid;?></p>
	<p><?php
	echo "账户余额           ";
	echo $ubal;?></p>
	<p><?php
	echo "职业             ";
	echo $uprof;?></p>
	<script language = "JavaScript">
        function change_info(){
            alert("修改信息");
            var dis = "<?php
            $url = "http://localhost/bike/bicyclesql-master/changeinfo.html?uid=".$uid;
            echo $url;?>";
            window.location.href = dis;
        }
        function select_record(){
            alert("查询订单信息");
            var dis = "<?php
            $url = "http://localhost/bike/bicyclesql-master/select_record.php?uid=".$uid;
            echo $url;?>";
            window.location.href = dis;
        }
        function charge(){
            alert("充值");
            var dis = "<?php
            $url = "http://localhost/bike/bicyclesql-master/charge.php?uid=".$uid;
            echo $url;?>";
            window.location.href = dis;
        }
        function transfer(){
            alert("提现");
            var dis = "<?php
            $url = "http://localhost/bike/bicyclesql-master/transfer.php?uid=".$uid;
            echo $url;?>";
            window.location.href = dis;
        }


        //还差一个用户支付状态的判断和跳转；】
        function usebike(){
            var dis = "<?php
            if($ubal <0){
              $url = "http://localhost/bike/bicyclesql-master/getinfo.php?uid=".$uid;
              echo $url;
            }
            else{
            if($lastpay == 0){
            $url = "http://localhost/bike/bicyclesql-master/userbike.html?uid=".$uid;
            echo $url;
            }
            else{
              $url = "http://localhost/bike/bicyclesql-master/usingbike.php?uid=".$uid;
              echo $url;
             }
           }
            ?>";
            window.location.href = dis;
        }
    </script>
	<input type="button" name="show" id="show" value="修改信息" onclick= "change_info();">
  <input type="button" name="show" id="show" value="查询订单信息" onclick= "select_record();">
	<input type="button" name="show" id="show" value="我要充值" onclick= "charge();">
	<input type="button" name="show" id="show" value="我要转出" onclick= "transfer();">
	<input type="button" name="show" id="show" value="立即用车" onclick= "usebike();">
</body>
</html>
