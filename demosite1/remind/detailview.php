<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .eachcmt {
            border: 1px solid gray;
        }
        .cmtcontents {
            width: 80%;
        }
        .cmtupdate {
            display: none;
        }
        .active {
        background-color : gray;
        }
    </style>
    <title>Document</title>
</head>
<body>
<?php

    $login_username = "댓글러";
    $conn = new mysqli("localhost", "remind", "remind", "remind");

    $id = $_GET['id'];

    $sql = "SELECT * FROM employee WHERE id = ".$id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<h1>개인정보 상세페이지</h1>
<table>
    <tr>
        <td><?=$row['emp_name']?></td>
        <td><?=$row['emp_number']?></td>
        <td><?=$row['emp_phone']?></td>
        <td><?=$row['emp_hiredate']?></td>
        <td><?=$row['emp_deptcode']?></td>
        <td><?=$row['emp_address']?></td>
        <td><?=$row['emp_email']?></td>
    </tr>
</table>
    
    <a href="update.php?id=<?=$id?>">수정</a>
    <a href="delete_process.php?id=<?=$id?>">삭제</a>
    <a href="list.php">목록으로</a>

    <hr>
    <!-- 여기부터 댓글 처리 -->
    <!-- 새 댓글 등록 FORM -->
    <form action="comment_process.php" method="POST">
        <input type="hidden" name="writer" value="<?=$login_username?>"><br>
        <input type="hidden" name="emp_id" value="<?=$id?>"><br>
        <input type="text" name="contents">
        <input type="submit" value="등록">
    </form>
    <hr>
    <?php
        // 코멘트 테이블에서 emp_id가 본 글(employee)의 id와 같은 것만 검색
        // 댓글 리스트
        $sql = "SELECT * FROM comment WHERE emp_id= ".$id;
        $resultset = $conn->query($sql);
        while($row = $resultset->fetch_assoc()) {
            $cmt_id = $row['cmt_id'];
    ?>
        <div class="eachcmt">
            <p class="cmtwriter"><?=$row['cmt_writer']?></p>
            <p class="cmtcontents"><?=$row['cmt_contents']?></p>    
            <a class="accordion">수정</a> &nbsp;&nbsp;&nbsp;

            <div class="cmtupdate">
                <form action="cmt_update_process.php" method="POST">
                    <input type="hidden" name="emp_id" value="<?=$id?>">
                    <input type="hidden" name="cmt_id" value="<?=$cmt_id?>">
                    <label>댓글내용 : </label>
                    <input type="text" name="cmt_contents" value="<?=$row['cmt_contents']?>">
                    <input type="submit" value="수정">
                    <input type="reset" value="취소">
                </form>
            </div>
            <a href="cmt_delete_process.php?cmt_id=<?=$cmt_id?>&emp_id=<?=$id?>">삭제</a>
        </div>
    <?php
        }
        // resource 반납
        $result->close();
        $resultset->close();
        $conn->close();
    ?>
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for(i=0; i < acc.length; i++){
        acc[i].addEventListener("click", function() {
        this.classList.toggle("active");

        var target = this.nextElementSibling;
        if(target.style.display === "block"){
            target.style.display = "none";
        }else {
            target.style.display = "block";
        }
    });
}
</script>
</body>
</html>
