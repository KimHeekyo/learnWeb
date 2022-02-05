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
    <?php
        if (!$chk_login) {
        ?>
        <div class="header_contents">
            <div class="logo">
                <a href="main.php"><img src="./image/logo.png" width="200px;" height="100px;"></a>
            </div>
            <ul class="login">
                <li class='logintab'><a href="loginform.php">로그인</a></li>
                <li class='logintab'><a href="./users/users_insert.php">회원가입</a></li>
            </ul>
        </div>

        <div class="header_nav">
            <div class="nav_menu">
                <div>
                    <ul>
                        <li class="menu"><a href="main.php">전체</a></li>
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

    
    <?php
    } else {
    ?>

<div class="header_contents">
            <div class="logo">
                <a href="main.php"><img src="./image/logo.png" width="200px;" height="100px;"></a>
            </div>
<?php
    $sql = "SELECT * FROM users WHERE username = '" .$_SESSION['username']."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
            <ul class="login">
                <li class='logintab'><?=$row['nickname']?>님</li>
                <li class='logintab'><a href="./users/users_logout.php">로그아웃</a></li>
                <li class='logintab'><a href="./users/users_info.php">내정보</a></li>
            </ul>
        </div>

        <div class="header_nav">
            <div class="nav_menu">
                <div>
                    <ul>
                        <li class="menu"><a href="main.php">전체</a></li>
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

    <button class="moviesubmit"><a href="movie_insert.php">영화등록</a></button>

    <?php
    }
    ?>

    <div id="container">
        <?php
            $sql = "SELECT * FROM movie";
            $resultset = $conn->query($sql);
            
            if ($resultset->num_rows > 0) {
            $row = $resultset->fetch_assoc();

            while ($row = $resultset->fetch_assoc()) {
        ?>
        <div class="card">
            <a href="movie_info.php"><img src="./poster/<?=$row['m_poster']?>" width="230px;" height="345px;"><a href="#">
            <div class="ct">
            <a href="movie_info.php"><h4><?=$row['m_title']?></h4></a>
                <p><?=$row['m_date']?> 개봉</p>
                <button class="ticket"><a href="#">예매하기</a></button>
            </div>
        </div>

        <?php
            }
        }
        ?>

    </div>
        
    
</body>
</html>