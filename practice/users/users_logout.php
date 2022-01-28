<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["userip"]);
    setcookie("username", "");
    setcookie("password");
    header("Location: ../main.php");
?>