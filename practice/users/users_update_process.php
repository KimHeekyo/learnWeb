<?php
    require "../util/db.php";

    $id = $_POST['id'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $phone_num = $_POST['phone_num'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET nickname = ?, password = ?, phone_num = ?, email = ? WHERE id = ?" );
    $stmt->bind_param("sssss", $nickname, $password, $phone_num, $email, $id);
    $stmt->execute();

    $conn->close();

    header('Location: users_info.php?id='.$id);
?>