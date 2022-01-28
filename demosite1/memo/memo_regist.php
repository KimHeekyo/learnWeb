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
</head>

<body>
  <h1>새 메모 작성 화면</h1>
  <form action="./memo_registprocess.php" method="POST">
    <input hidden  type="text" name="username" value="<?=$username?>" />
    <label>제목 </label><input type="text" name="title" placeholder="enter title" required /><br>
    <label>내용</label><input type="text" name="contents" placeholder="enter contents" required /><br>
    <input type="submit" value="Save">
    <input type="reset" vlaue="Cancel">
  </form>
</body>
<?php
} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>인덱스페이지로</a>";
}
?>
</html>