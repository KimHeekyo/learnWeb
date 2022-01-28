<?php
    // get connection
    $conn = new mysqli("localhost", "remind", "remind", "remind");
    // get id from parameter
    $id = $_GET['id'];
    // make sql
    $sql = "DELETE FROM employee WHERE id = ".$id;
    // execute query
    $conn->query($sql);
    // close resource
    $conn->close();
    // redirection to list page (Location 다음 공백있으면 연결 안됨)
    header('Location: ./list.php');
?>