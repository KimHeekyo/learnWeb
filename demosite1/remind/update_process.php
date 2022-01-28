<?php
    // get connection to database
    $conn = new mysqli("localhost", "remind", "remind", "remind");
    // get id from update form
    $id = $_POST['id'];
    $emp_phone = $_POST['emp_phone'];
    $emp_address = $_POST['emp_address'];
    $emp_deptcode = $_POST['emp_deptcode'];
    $emp_email = $_POST['emp_email'];
    // make sql statement to update
    $stmt = $conn->prepare("UPDATE employee SET emp_phone = ?, emp_address = ?, emp_deptcode = ?, emp_email = ? WHERE id = ?");
    $stmt->bind_param("ssiss", $emp_phone, $emp_address, $emp_deptcode, $emp_email, $id);

    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: ./detailview.php?id='.$id);
?>