<!-- 입력을 위한 화면 구성 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>인사정보 입력화면</h1>
    <form action="insert_process.php" method="POST">
        <label>성명 : </label><input type="text" name="emp_name" /><br>
        <label>사원번호 : </label><input type="text" name="emp_number" /><br>
        <label>전화번호 : </label><input type="text" name="emp_phone" /><br>
        <label>부서코드 : </label><input type="text" name="emp_deptcode" /><br>
        <label>주소 : </label><input type="text" name="emp_address" /><br>
        <label>이메일 : </label><input type="email" name="emp_email" /><br>
        <input type="submit" value="저장">
    </form>
</body>
</html>
