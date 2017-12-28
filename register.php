<?php
require_once 'public.php';

$uid = $_POST["userid"];
$name = $_POST["username"];
$pwd = $_POST["userpss1"];
$prof = $_POST["userprof"];
$paypss = $_POST["paypssw1"];
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
    header("refresh:3;url=login.html");
    print('该用户已注册过，请直接登录~~~');
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
    $bal = 100;
    $account_query = "INSERT INTO account(userid, balance, paypssw)
                        VALUES('{$uid}', '{$bal}', '{$paypss}');";
    $result = mysqli_query($db, $account_query);
    echo $account_query;
    //注册成功，跳转到登录页面
    header("refresh:3;url = login.html"); 
    print("注册成功，三秒后跳转到登录页面。。。。。。");

}
?>
