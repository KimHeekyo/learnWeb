<?php
    $cmt_id = $_GET['cmt_id'];
    $emp_id = $_GET['emp_id'];
    
    $conn = new mysqli("localhost", "remind", "remind", "remind");
    $sql = "DELETE FROM comment WHERE cmt_id =".$cmt_id;
    $conn->query($sql);

    header('Location: detailview.php?id='.$emp_id);
?>