<!-- 수정을 위한 화면 구성 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // 데이터베이스 연결 설정
        $conn = new mysqli("localhost", "remind", "remind", "remind");
        // detailview의 수정 링크로부터 id 값을 가지고옴(GET)
        $id = $_GET['id'];
        // id에 해당하는 레코드를 검색하는 sql문 구성
        $sql = "SELECT * FROM employee WHERE id = ".$id;
        // 질의문 실행
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <h1>인사정보 수정화면</h1>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="id" value="<?=$row['id']?>" /><br>
        <label>성명 : </label><input type="text" name="emp_name" value="<?=$row['emp_name']?>" readonly /><br>
        <label>사원번호 : </label><input type="text" name="emp_number" value="<?=$row['emp_number']?>" readonly /><br>
        <label>전화번호 : </label><input type="text" name="emp_phone" value="<?=$row['emp_phone']?>" /><br>
        <label>부서코드 : </label><input type="text" name="emp_deptcode" value="<?=$row['emp_deptcode']?>" /><br>
        <label>입사일 : </label><input type="text" name="emp_hiredate" value="<?=$row['emp_hiredate']?>" readonly /><br>
        <label>주소 : </label><input type="text" name="emp_address" value="<?=$row['emp_address']?>" /><br>
        <label>이메일 : </label><input type="email" name="emp_email" value="<?=$row['emp_email']?>" /><br>
        <input type="submit" value="수정">
    </form>
</body>
</html>
