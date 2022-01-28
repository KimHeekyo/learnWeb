<?php
// db연결 준비
require "../util/dbconfig.php";
// 로그인한 상태일 때만 메모 작성 가능
require_once '../util/loginchk.php';

if($chk_login){
  $username = $_SESSION["username"];//session에서 사용자 이름을 얻는다.
  $conum = $_POST['conum'];
  $bonum = $_POST['bonum'];
//   $contents $_POST['contents'];
  


  $stmt = $conn->prepare("INSERT INTO comment(username, conum, bonum) VALUES(?, ?, ?)");
  $stmt->bind_param("sss", $username, $conum, $bonum);

  $stmt->execute();

  $stmt->close();
  $conn->close();

  
  echo outmsg(COMMIT_CODE);
  echo "<a href='./board_list.php'>게시판 목록</a>";

} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인화면으로</a>";
}
?>