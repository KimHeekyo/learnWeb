<!-- 
  파일명 : memo_regist_process.php
  최초작업자 : swcodingschool
  최초작성일자 : 2022-1-3
  업데이트일자 : 2022-1-3
  
  기능: 
  memo_regist.php 메모 작성화면에서 입력된 값을 받아, validation 후
  memo 테이블에 메모 데이터를 추가한다.
-->
<?php
// db연결 준비
require "../util/dbconfig.php";
// 로그인한 상태일 때만 메모 작성 가능
require_once '../util/loginchk.php';

if($chk_login){
  // 로그인한 사용자에 한해서 
  // 데이터베이스 작업 전, 메모작성화면으로 부터 값을 전달 받고
  $username = $_SESSION['username'];
  $title = $_POST['title'];
  $contents = $_POST['contents'];
  
  // 입력 처리를 위한 prepared sql 구성 및 bind
  $stmt = $conn->prepare("INSERT INTO memo(username, title, contents) VALUES(?, ?, ?)");
  $stmt->bind_param("sss", $username, $title, $contents);
  $stmt->execute();

  $conn->close();

  echo outmsg(COMMIT_CODE);
  echo "<a href='./memo_list.php'>메모 목록 페이지로</a>";
}else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>Confirm and Return to index.</a>";
}
?>