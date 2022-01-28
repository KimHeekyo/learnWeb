<?php

$practicedb = 'practice';

$dbservername = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = $practicedb;

require_once "../util/utility.php";

$conn = new mysqli($dbservername, $dbusername, $dbpassword);

if($conn->connect_error) {
    echo outmsg(DBCONN_FAIL);
    die("연결실패 :".$conn->connect_error);
} else {
    if (DBG) echo outmsg(DBCONN_SUCCESS);
}

$sql = "DROP DATABASE IF EXISTS " . $dbname . ";";
if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(DROPDB_SUCCESS);
}
$sql = "DROP USER IF EXISTS " . $dbname . ";";
if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(DROPUSER_SUCCESS);
}

$sql = "CREATE USER IF NOT EXISTS '" . $dbname. "'@'%' IDENTIFIED BY '" . $dbname . "'";
if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(CREATEUSER_SUCCESS);
} else {
    echo outmsg(CREATEUSER_FAIL);
}

$sql = "GRANT USAGE ON *.* TO '" . $dbname . "'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(LIMITRSC_SUCCESS);
} else {
    echo outmsg(LIMITRSC_FAIL);
}

$sql = "CREATE DATABASE IF NOT EXISTS `" . $dbname . "`";
if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(CREATEDB_SUCCESS);
} else {
    echo outmsg(CREATEDB_FAIL);
}

$sql = "GRANT ALL PRIVILEGES ON `" . $dbname . "`.* TO '" . $dbname . "'@'%';  ";
if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(GRANTUSER_SUCCESS);
} else {
    echo outmsg(GRANTUSER_FAIL);
}

$conn->close();

if (DBG) echo outmsg(COMMIT_CODE);

if (DBG) {
    echo "<a href='../users/users_initiate.php'>사용자 테이블 생성</a>";
} else {
    header('Location: ../users/users_initiate.php');
}

?>