<?php
    $TARGET = "EC2";    // 호스트명
    if($TARGET == "EC2") {
        header('Location: ./site_initiate.php');
    } else {
        header('Location: ./membership/app_initiate.php');
    }
?>