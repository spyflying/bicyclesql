<html>
<body>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" >
    function updata(){
        $("#datetime").load("from1.php #datetime");
    }
    setInterval(updata, 1000);
</script>

<p id='datetime' class="test-muted">
    <?php
    date_default_timezone_set("Asia/Beijing");
    echo "当前北京时间是 " . date('h:i:s');
    ?>
</p>

</body>
</html>  
