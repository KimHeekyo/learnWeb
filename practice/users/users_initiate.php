<?php

require "../util/db.php";

$sql = "DROP TABLE IF EXISTS users";
if($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(DROPTBL_SUCCESS);
}

$sql = "CREATE TABLE users (
    `id` INT(6) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL,
    `nickname` VARCHAR(20) NOT NULL,
    `password` VARCHAR(256) NOT NULL,
    `phone_num` VARCHAR(13) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `registdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `lastdate` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";

if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(CREATETBL_SUCCESS);
} else {
    echo outmsg(CREATETBL_FAIL);
}


$conn-> close();

if(DBG){ 
    echo "<a href='../movie/movie_initiate.php'>영화 정보 테이블 생성</a>";
}else {
    header('Location: ../movie/movie_initiate.php');
}

?>