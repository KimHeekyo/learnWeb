<?php
    // form 화면에서 입력된 내용을 받아오기
    $emp_name = $_POST['emp_name'];
    $emp_number = $_POST['emp_number'];
    $emp_phone = $_POST['emp_phone'];
    $emp_deptcode = $_POST['emp_deptcode'];
    $emp_address = $_POST['emp_address'];
    $emp_email = $_POST['emp_email'];

    // 데이터베이스 연결
    $hostname = "localhost";
    $username = "remind";
    $password = "remind";
    $dbname = "remind";
    $conn = new mysqli($hostname, $username, $password, $dbname);
    if($conn->connect_error) {
        die("데이터베이스 연결에 문제가 있습니다. ".$conn->connect_error);
    }


    // 데이터베이스 입력을 위한 SQL 구문 구성
    // 단순하게 하기위해 prepared statement로 구성
    $stmt = $conn->prepare("INSERT INTO employee(emp_name, emp_number, emp_phone, emp_deptcode, emp_address, emp_email)
                            values (?, ?, ?, ?, ?, ?)");
    // prepared statement와 변수파라미터를 bind로 묶어줌
    $stmt->bind_param("sssiss", $emp_name, $emp_number, $emp_phone, $emp_deptcode, $emp_address, $emp_email);

    // 질의문을 execute()로 수행
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: ./list.php");
?>