<?php

$practicedb = 'localhost';

$dbservername = 'localhost';
$dbusername = $practicedb;
$dbpassword = $practicedb;
$dbname = $practicedb;

require_once "utility.php";

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

if($conn->connect_error) {
    echo outmsg(DBCONN_FAIL);
    die("연결실패 :".$conn->connect_error);
} else {
    if (DBG) echo outmsg(DBCONN_SUCCESS);
}


?>