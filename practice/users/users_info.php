<?php
require "../util/db.php";
require_once '../util/utility.php';
require_once '../util/login.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/usersinfo.css">

</head>
<body>
<div class="header_contents">
            <div class="logo">
                <a href="../main.php"><img src="../image/logo.png" width="200px;" height="100px;"></a>
            </div>
<?php
    $sql = "SELECT * FROM users WHERE username = '" .$_SESSION['username']."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
            <ul class="login">
                <li class='logintab'><?=$row['nickname']?>님</li>
                <li class='logintab'><a href="users_logout.php">로그아웃</a></li>
                <li class='logintab'><a href="users_info.php?id=<?=$row['id']?>">MY</a></li>
            </ul>
        </div>

        <div class="header_nav">
            <div class="nav_menu">
                <div>
                    <ul>
                    <li class="menu"><a href="users_info.php?id=<?=$row['id']?>">내 정보</a></li>
                        <li class="menu"><a href="#">예매내역</a></li>
                    </ul>
                </div>
                <div id="search_box">
                    <form action="" method="GET">
                        <input type="text" name="" size="30" class="search_bar" required="required">
                        <button class="search_btn">검색</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align:center; padding: 50px;"><h1>내 정보</h1></div>
    <div id="container">
        <?php

        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id =" . $id;
        $resultset = $conn->query($sql);
            
        if ($resultset->num_rows > 0) {
        $row = $resultset->fetch_assoc();
        ?>

        
        <table>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">아이디</td>
                <td width="200" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['username']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">닉네임</td>
                <td width="200" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['nickname']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">전화번호</td>
                <td width="200" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['phone_num']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">이메일</td>
                <td width="200" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['email']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">가입일</td>
                <td width="200" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['registdate']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">수정일</td>
                <td width="200" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['lastdate']?></td>
            </tr>
        </table>
        <br>
        <div class="uifu">
            <a href="users_update.php?id=<?=$row['id']?>">회원수정</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="users_delete_process.php?id=<?=$row['id']?>">회원탈퇴</a>
        </div>




        <?php
            }
        ?>

    </div>
        
    
</body>
</html>