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
        $cmt_id = $_GET['cmt_id'];
        $emp_id = $_GET['emp_id'];

        $conn = new mysqli("localhost", "remind", "remind", "remind");
        $sql = "SELECT * FROM comment WHERE cmt_id = ".$cmt_id;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

    ?>
    
    <form action="cmt_update_process.php" method="POST">
        <input type="hidden" name="emp_id" value="<?=$emp_id?>">
        <input type="hidden" name="cmt_id" value="<?=$cmt_id?>">
        <label>댓글내용 : </label>
        <input type="text" name="cmt_contents" value="<?=$row['cmt_contents']?>">
        <input type="submit" value="수정">
    </form>
</body>
</html>