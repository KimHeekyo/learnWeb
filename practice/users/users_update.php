<?php

require "../util/db.php";

require_once "../util/login.php";

if($chk_login) {
$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id=" . $id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_array();
    $username = $row['username'];
    $nickname = $row['nickname'];
    $password = $row['password'];
    $phone_num = $row['phone_num'];
    $email = $row['email'];
    } else {
    echo outmsg(INVALID_USER);
}
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
    <div class="header">

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

    
    <div style="text-align:center; padding: 50px;"><h1>내 정보 수정</h1></div>
    <div id="container">


        <form action="users_update_process.php" method="POST">
        <table>
            <input type ="hidden" name="id" value="<?=$id?>" />
        <tr>
            <td width="150" height="50" style="background-color: whitesmoke">아이디</td>
            <td width="200" height="50"><input type ="text" name="username" value="<?=$row['username']?>" style="border: 1px solid lightgray; padding: 17px" readonly/></td>
        </tr>
        <tr>
            <td width="150" height="50" style="background-color: whitesmoke">닉네임</td>
            <td width="200" height="50"><input type ="text" name="nickname" value="<?=$row['nickname']?>" style="border: 1px solid lightgray; padding: 17px" /></td>
        </tr>
        <tr>
            <td width="150" height="50" style="background-color: whitesmoke">비밀번호</td>
            <td width="200" height="50"><input type ="password" name="password" value="<?=$row['password']?>" style="border: 1px solid lightgray; padding: 17px" /></td>
        </tr>
        <tr>
            <td width="150" height="50" style="background-color: whitesmoke">전화번호</td>
            <td width="200" height="50"><input type ="text" name="phone_num" value="<?=$row['phone_num']?>" style="border: 1px solid lightgray; padding: 17px" required/></td>
        </tr>
        <tr>
            <td width="150" height="50" style="background-color: whitesmoke">이메일</td>
            <td width="200" height="50"><input type ="text" name="email" value="<?=$row['email']?>" style="border: 1px solid lightgray; padding: 17px" required/></td>
        </tr>
        </table>
        <div class="updatebtn">
        <input type="submit" value="수정">
        <input type="reset" value="취소">
        </div>
        </form>
    <?php
    }
?>
</body>
</html>