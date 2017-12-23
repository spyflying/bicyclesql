<?php
require_once 'public.php';

?>
<html>
<head>
    <title>注册</title>
    <?php include 'parts/head.php'; ?>
</head>
<body>
    <?php include 'parts/nav.php'; ?>
    <div class="container">
        <h1>注册用户</h1>
        <?php
        $statement = $db->prepare(<<<QUERY
INSERT INTO `用户` values(NULL, ?, ?, ?, ?, ?, ?, 0, 0)
QUERY
        );

        $dpID = 20;
        $statement->bind_param("ssssss", $_POST['UserName'],  $dpID, $_POST['RealName'], $_POST['Password'], $_POST['Gender'], $_POST['PhoneNumber']);

        $passwd = $_POST['Password'];
        $passwd_confirm = $_POST['Password_confirm'];
        if($passwd != $passwd_confirm) {?>
            <p>两次密码不一致！</p>
        <?php } else {
            if ($statement->execute()) { ?>
            <p>注册成功！</p>
            <p>
                昵称 = <?= $_POST['UserName'] ?> <br>
                真实姓名 = <?= $_POST['RealName'] ?> <br>
                性别 = <?= $_POST['Gender'] ?> <br>
                联系方式 = <?= $_POST['PhoneNumber'] ?><br>
            </p>
            <?php } else { ?>
            <p>注册失败……</p>
            <p>
                昵称 = <?= $_POST['UserName'] ?> <br>
                真实姓名 = <?= $_POST['RealName'] ?> <br>
                性别 = <?= $_POST['Gender'] ?> <br>
                联系方式 = <?= $_POST['PhoneNumber'] ?><br>
            </p>
            <?php }
        }?>
    </div>
</body>
