<?php
require "./util/db.php";
require_once './util/utility.php';
require_once './util/login.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/mainstyle.css">

</head>
<body>
    <div class="header">
        <div class="header_contents">
            <div class="logo">
                <a href="main.php"><img src="./image/logo.png" width="200px;" height="100px;"></a>
            </div>

            <ul class="login">
                <li class='logintab'><a href="loginform.php">로그인</a></li>
                <li class='logintab'><a href="./users/users_insert.php">회원가입</a></li>
                <li class='logintab'><a href="#">내정보</a></li>
            </ul>
        </div>

        <div class="header_nav">
            <div class="nav_menu">
                <div>
                    <ul>
                        <li class="menu"><a href="#">전체</a></li>
                        <li class="menu"><a href="#">메뉴</a></li>
                        <li class="menu"><a href="#">메뉴</a></li>
                        <li class="menu"><a href="#">메뉴</a></li>
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

    <div id="container">
        <form action="loginform_process.php" method="POST" class="login_form">
            <label></label><input type="text" name="username" class="login_box" placeholder="  아이디" required /><br>
            <label><input type="password" name="password" class="login_box" placeholder="  비밀번호" required /><br>
            <button type="submit" class="login_box" id="login_btn"><b>로그인</b></button><br>
            <label>
                <input type="checkbox" value="yes" name="chkbox"> 아이디 기억하기 
            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./users/users_insert.php">회원가입</a>
        </form>
    </div>
</body>
</html>