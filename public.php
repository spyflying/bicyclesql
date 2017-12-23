<?php
error_reporting(E_ERROR);

//ini_set("display_errors","Off");

session_start();
//mysqli_report(MYSQLI_ASSOC);
mysqli_report(MYSQLI_REPORT_ERROR);
$db = mysqli_connect('localhost', 'bicycledb', 'hellobicycle', 'bicycledb'); 
$sql = "INSERT INTO user(userid, userpss) VALUES(?,?)";

if ($db->connect_errno)
{
    echo json_encode(array(
        'success' => false,
        'message' => "Error occurred while processing your request: $db->connect_error. Please contact me to do me a favor~"
    ));
    exit;
}

//echo "yeah!";


/*$shouldDie = false;
if(isset($_GET["RegionID"])) {
    $_SESSION["RegionID"] = $_GET["RegionID"];
    $shouldDie = true;
} else if(!isset($_SESSION["RegionID"])) {
    $_SESSION["RegionID"] = "北京";
    $_SESSION["DeliveryPointID"] = 1;
}
if(isset($_GET["DeliveryPointID"])) {
    $_SESSION["DeliveryPointID"] = $_GET["DeliveryPointID"];
    $shouldDie = true;
}

if ($shouldDie) {
    $params = [];
    $suffix = "";
    foreach ($_GET as $k => $v)
        if ($k != "DeliveryPointID" && $k != "RegionID")
            array_push($params, $k."=".$v);
    if (count($params) > 0)
        $suffix .= "?" . implode("&", $params);
    header("Location: ".$_SERVER['SCRIPT_NAME'].$suffix);
    die;
}*/
