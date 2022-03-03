<?php

require "../util/db.php";

$sql = "DROP TABLE IF EXISTS movie";
if($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(DROPTBL_SUCCESS);
}

$sql = "CREATE TABLE movie (
    `m_id` INT(6) NOT NULL AUTO_INCREMENT,
    `m_poster` VARCHAR(200) NULL,
    `m_title` VARCHAR(20) NOT NULL,
    `m_director` VARCHAR(20) NOT NULL,
    `m_date` VARCHAR(20) NOT NULL,
    `m_genre` VARCHAR(50) NOT NULL,
    `m_country` VARCHAR(50) NOT NULL,
    `m_time` VARCHAR(20) NOT NULL,
    `m_story` VARCHAR(2000) NOT NULL,
    `m_audience` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`m_id`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";

if ($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(CREATETBL_SUCCESS);
} else {
    echo outmsg(CREATETBL_FAIL);
}


$conn-> close();

if(DBG){ 
    echo "<a href='../main.php'>메인화면</a>";
}else {
    header('Location: ../main.php');
}

?>