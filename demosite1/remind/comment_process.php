<?php
    // 코멘트 폼에서 값을 전달 받는다.
    $writer = $_POST['writer'];
    $emp_id = $_POST['emp_id'];
    $contents = $_POST['contents'];

    // 데이터베이스 연결 설정
    $conn = new mysqli("localhost", "remind", "remind", "remind");

    // 코멘트 추가를 위한 sql문 구성
    $stmt = $conn->prepare("INSERT INTO comment(cmt_writer, emp_id, cmt_contents) VALUES (?, ?, ?)");
    $stmt -> bind_param("sss", $writer, $emp_id, $contents);
    
    $stmt -> execute();
    $stmt -> close();

    header('Location: detailview.php?id='.$emp_id);
?>