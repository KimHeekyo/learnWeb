<?php
    $cmt_id = $_POST['cmt_id'];
    $emp_id = $_POST['emp_id'];
    $cmt_contents = $_POST['cmt_contents'];

    $conn = new mysqli("localhost", "remind", "remind", "remind");
    $stmt = $conn->prepare("UPDATE comment SET cmt_contents = ? WHERE cmt_id = ? ");
    $stmt -> bind_param("ss", $cmt_contents, $cmt_id);
    $stmt -> execute();

    $stmt->close();
    $conn->close();

    header('Location: detailview.php?id='.$emp_id);
?>