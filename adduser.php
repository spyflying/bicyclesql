<?php
require_once 'public.php';

$uid = $_POST["uid"];
$name = $_POST["uname"];
$pwd = $_POST["upss"];
$prof = $_POST["uprof"];
$paypss = $_POST["paypssw"];
$balance = $_POST["balance"];
$utype = 0;

echo "enter";
//判断是否已存在该用户
$uid_query = "SELECT *
              FROM user
              WHERE userid = '{$uid}';";
$result = mysqli_query($db, $uid_query);
echo mysqli_num_rows($result);
if(mysqli_num_rows($result)){
    //该用户已注册过
    header("refresh:3;url=manager.html");
    print('该用户已注册过，添加失败~~~');
}

else{
    echo "yes";
    $uid_query = "INSERT INTO user(userid, username, userpss, userprof, usertype)
                VALUES('{$uid}', '{$name}', '{$pwd}', '{$prof}', '{$utype}');";
    echo $uid_query;
    $result = mysqli_query($db, $uid_query);
    if(!$result){
        die('Cannot insert data: ' . mysqli_error($db));
    }
    //$bal = 100;
    $account_query = "INSERT INTO account(userid, balance, paypssw)
                        VALUES('{$uid}', '{$balance}', '{$paypss}');";
    $result = mysqli_query($db, $account_query);
    echo $account_query;
    //注册成功，跳转到登录页面
    header("refresh:3;url = manager.html"); 
    print("添加成功");

}
?>
