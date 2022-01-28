<?php

$hostname = "localhost";
$username = "root";
$password = "";
// PHP와 MySQL간의 연결을 설정하고 이를 $conn이라는 이름으로 정함
// 초기화를 위한 연결로써 아직 데이터베이스는 없는 상태이다.
// 이 코드에서 데이터베이스, 사용자, 테이블을 생성해보자.
$conn = new mysqli($hostname, $username, $password);
// mysqli 생성자가 리턴한 값이 null이 아니라면 연결 설정이 된다.
if(!$conn->connect_error) {
    echo "<script>alert('DBMS와 연결이 설정되었습니다.')</script>";
} else {
    echo "<script>alert('DBMS와 연결을 설정할 수 없습니다. \\n호스트명, 계정, 비밀번호를 확인해주세요.')</script>";
}
// 아래 코드는 PDO에 의한 방법
// try {
//     $conn = new PDO("mysql:host=$hostname;", $username, $password);
//     // set the PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "<script>alert('DBMS와 연결이 설정되었습니다.')</script>";
// } catch(PDOException $e) {
//     echo "<script>alert('DBMS와 연결을 설정할 수 없습니다. \\n호스트명, 계정, 비밀번호를 확인해주세요.')</script>" . $e->getMessage();
// }


// Create DB 과정
// 먼저, 기존에 존재하는 DB가 있으면 삭제하고
$dbname= "remind";
$sql = "DROP DATABASE IF EXISTS " .$dbname;
$conn->query($sql);
// 만들고자하는 이름으로 데이터베이스를 생성한다.
$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
$conn->query($sql);

// Create User
// 먼저, 기존에 존재하는 account가 있으면 삭제하고
$account = $dbname;
$sql = "DROP USER IF EXISTS ".$account;
$conn->query($sql);
// 만들고자하는 이름으로 애플리케이션용 계정을 생성한다.
$sql = "CREATE USER IF NOT EXISTS '" . $account . "'@'%' IDENTIFIED BY '" . $account . "'";
$conn->query($sql);
// 생성된 계정에 리소스 제한 처리하고
$sql = "GRANT USAGE ON *.* TO '".$account."'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
$conn->query($sql);
//생성된 계정에 특정 데이터베이스에 대한 권한 부여
$sql = "GRANT ALL PRIVILEGES ON `".$dbname."` .* TO '".$account."'@'%'";
$conn->query($sql);

// 명시적으로 현재 사용 DB 선언
$sql = "use ".$dbname;
$conn->query($sql);


// Create Table
// 먼저, 존재하는 테이블이 있으면 삭제하고
$sql = "DROP TABLE IF EXISTS `".$dbname."`.`employee`";
$conn->query($sql);

// 새롭게 테이블 생성
$sql = "CREATE TABLE IF NOT EXISTS `".$dbname."`.`employee` (
    `id` INT(6) NOT NULL AUTO_INCREMENT ,
    `emp_name` VARCHAR(50) NOT NULL ,
    `emp_number` VARCHAR(10) NOT NULL ,
    `emp_phone` VARCHAR(13) NULL ,
    `emp_hiredate` DATE NULL DEFAULT CURRENT_TIMESTAMP ,
    `emp_deptcode` INT(6) NULL ,
    `emp_address` VARCHAR(200) NULL ,
    `emp_email` VARCHAR(50) NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);

// 목록의 pagination 처리를 위한 모의 데이터 추가
for($i = 1; $i <= 345; $i++) {
    $emp_num = 'empnum '.$i;
    $emp_name = 'empname '.$i;

    $stmt = $conn->prepare("INSERT INTO employee(emp_number, emp_name) VALUES(?, ?)");
    $stmt -> bind_param("ss", $emp_num, $emp_name);
    $stmt -> execute();
}

// 댓글 처리를 위한 테이블 생성
// ON DELETE CASCADE = 상위 테이블의 행이 삭제되거나 업데이트되면 하위 테이블에서 일치하는 행의 값이 자동으로 삭제
$sql = "CREATE TABLE comment (
    `cmt_id` INT(6) NOT NULL AUTO_INCREMENT ,
    `cmt_writer` VARCHAR(50) NOT NULL ,
    `cmt_contents` VARCHAR(600) NOT NULL ,
    `emp_id` INT(6) NOT NULL ,
    PRIMARY KEY (`cmt_id`),
    FOREIGN KEY (`emp_id`) REFERENCES employee(`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);
$stmt->close();
$conn->close();


// if($conn != null) {
//     $conn->close();
//     "<script>alert('DBMS와 연결을 종료합니다.')</script>";
// }
?>