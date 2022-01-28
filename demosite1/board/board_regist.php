<?php
// db연결 준비
require "../util/dbconfig.php";
// 로그인한 상태일 때만 메모 작성 가능
require_once '../util/loginchk.php';

if($chk_login){
  $username = $_SESSION["username"];//session에서 사용자 이름을 얻는다.
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>toy project 1st</title>
  <link rel="stylesheet" href="/css/boardstyle.css">
</head>

<body>
  <h1 class="title">새 게시글</h1>

<form action="./board_registprocess.php" method="POST" enctype="multipart/form-data">
  <table style="padding-top:50px" align="center" width="700" border="0" cellpadding="2">
    <tr>
      <td height="30" align="center" bgcolor="#ccc"><font color="white">게시물 작성</font></td>
    </tr>
    <tr>
    <td bgcolor="white">
    <table class ="table2" width="700">
      <tr>
        <td align="center">작성자</td>
        <td><input type="hidden" name="username" value="<?=$_SESSION['username']?>"><?=$_SESSION['username']?></td>
      </tr>

      <tr>
        <td align="center">제목</td>
        <td><input type="text" name="title" size="60"></td>
      </tr>

      <tr>
        <td align="center">내용</td>
        <td><textarea name="contents" cols="85" rows="15"></textarea></td>
      </tr>

    </table>
    <input type="file" name="uploadfile">
    <center>
      <input type="submit" value="등록">
      <input type="reset" value="초기화">
    </center>
    </td>
  </tr>
  </table>
  </form>
</body>
<?php
} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인화면으로</a>";
}
?>
</html>