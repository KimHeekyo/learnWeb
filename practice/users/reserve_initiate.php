<?php

require "../util/db.php";

$sql = "DROP TABLE IF EXIST reserve";
if($conn->query($sql) == TRUE) {
    if (DBG) echo outmsg(DROPTBL_SUCCESS);
}

$sql = "CREATE TABLE reserve (
    `r_id` INT(6) NOT NULL AUTO_INCREMENT,
    `nickname` VARCHAR(20) NOT NULL,
    `phone_num` VARCHAR(13) NOT NULL,
    
    )"
?>