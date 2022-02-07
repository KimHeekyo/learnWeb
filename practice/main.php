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
                        <li class="menu"><a href="?genre=액션">액션</a></li>
                        <li class="menu"><a href="?genre=코미디">코미디</a></li>
                        <li class="menu"><a href="?genre=로맨스">로맨스</a></li>
                        <li class="menu"><a href="?genre=드라마">드라마</a></li>
                        <li class="menu"><a href="?genre=판타지">판타지</a></li>
                    </ul>
                </div>
                <div id="search_box">
                    <form action="serch_result.php" method="GET">
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
                <li class='logintab'><a href="./users/users_info.php?id=<?=$row['id']?>">MY</a></li>
            </ul>
        </div>

        <div class="header_nav">
            <div class="nav_menu">
                <div class="tab">
                    <ul>
                        <li class="menu"><a href="main.php">전체</a></li>
                        <li class="menu"><a href="?genre=액션">액션</a></li>
                        <li class="menu"><a href="?genre=코미디">코미디</a></li>
                        <li class="menu"><a href="?genre=로맨스">로맨스</a></li>
                        <li class="menu"><a href="?genre=드라마">드라마</a></li>
                        <li class="menu"><a href="?genre=판타지">판타지</a></li>
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
            if(isset($_GET['genre']) && $_GET['genre']!=''){
                $genre=$_GET['genre'];
                $sql = "SELECT * FROM movie WHERE m_genre LIKE '%".$genre."%'";
            }else {
                $sql = "SELECT * FROM movie";
            }
            
            $resultset = $conn->query($sql);
            if ($resultset->num_rows > 0) {
            while ($row = $resultset->fetch_assoc()) {
        ?>
        <div class="card">
            <a href="movie_info.php?id=<?=$row['id']?>"><img src="./poster/<?=$row['m_poster']?>" width="230px;" height="345px;"></a>
            <div class="ct">
            <a href="movie_info.php?id=<?=$row['id']?>"><h4><?=$row['m_title']?></h4></a>
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