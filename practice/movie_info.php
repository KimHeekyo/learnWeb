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
    <link rel="stylesheet" href="./css/movieinfo.css">

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
                        <li class="menu"><a href="main.php?genre=액션">액션</a></li>
                        <li class="menu"><a href="main.php?genre=코미디">코미디</a></li>
                        <li class="menu"><a href="main.php?genre=로맨스">로맨스</a></li>
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
                <li class='logintab'><a href="./users/users_info.php?id=<?=$row['id']?>">MY</a></li>
            </ul>
        </div>

        <div class="header_nav">
            <div class="nav_menu">
                <div>
                    <ul>
                        <li class="menu"><a href="main.php">전체</a></li>
                        <li class="menu"><a href="main.php?genre=액션">액션</a></li>
                        <li class="menu"><a href="main.php?genre=코미디">코미디</a></li>
                        <li class="menu"><a href="main.php?genre=로맨스">로맨스</a></li>
                        <li class="menu"><a href="main.php?genre=드라마">드라마</a></li>
                        <li class="menu"><a href="main.php?genre=판타지">판타지</a></li>
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
    }
    ?>

    <div style="text-align:center; padding: 50px;"><h1>영화 상세정보</h1></div>

    <div id="container">
        <?php
            $id = $_GET['id'];

            $poster = './poster/';

            $sql = "SELECT * FROM movie WHERE id =" . $id;
            $resultset = $conn->query($sql);
            
            if ($resultset->num_rows > 0) {
            $row = $resultset->fetch_assoc();
        ?>
        <div class='info_poster'>
        <img src='<?=$poster.$row['m_poster'] ?>' width='400px;' height='600px;'>
        </div>

        <table>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">제목</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_title']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">감독</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_director']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">개봉일</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_date']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">장르</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_genre']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">국가</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_country']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">런타임</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_time']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">줄거리</td>
                <td width="500" height="100" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_story']?></td>
            </tr>
            <tr>
                <td width="150" height="50" style="background-color: whitesmoke">공급</td>
                <td width="500" height="50" style="border-top: 1px solid lightgray; border-bottom: 1px solid lightgray;"><?=$row['m_audience']?></td>
            </tr>
            <tr>
                <td><button class="ticket"><a href="#">예매하기</a></button></td>
            </tr>
        </table>

        

        <?php
        }
        ?>
        

    </div>
        
    
</body>
</html>