<!-- 
  파일명 : board_regist_process.php
  최초작업자 : swcodingschool
  최초작성일자 : 2022-1-3
  업데이트일자 : 2022-1-3
  
  기능: 
  board_regist.php 메모 작성화면에서 입력된 값을 받아, validation 후
  board 테이블에 메모 데이터를 추가한다.
-->
<?php
// db연결 준비
require "../util/dbconfig.php";
// 로그인한 상태일 때만 메모 작성 가능
require_once '../util/loginchk.php';

$upload_path = './uploadfiles/';

if($chk_login){
  // 로그인한 사용자에 한해서 
  // 데이터베이스 작업 전, 메모작성화면으로 부터 값을 전달 받고
  $username = $_SESSION['username'];
  $title = $_POST['title'];
  $contents = $_POST['contents'];

  // 업로드 파일 처리
  if(is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
    // $filename = $_FILES['uploadfile']['name']; 이렇게 쓰면 중복이 일어날 수 있으니
    // 파일명앞에 타임스태프를 붙인다
    $filename = time()."_".$_FILES['uploadfile']['name']; // time()은 현재 시간을 가져옴

  if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upload_path.$filename)) {
    if(DBG) echo outmsg(UPLOAD_SUCCESS);

    $stmt = $conn->prepare("INSERT INTO board(username, title, contents, uploadfile) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $title, $contents, $filename);
  } else {
    if(DBG) echo outmsg(UPLOAD_ERROR);
  }
}else {
    $stmt = $conn->prepare("INSERT INTO board(username, title, contents) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $username, $title, $contents);
  }
  
  
  // 입력 처리를 위한 prepared sql 구성 및 bind
  // for문을 이용하여 글 여러개 작성 가능
  // for ($title = 1; $title < 200; $title ++) {
  //$stmt = $conn->prepare("INSERT INTO board(username, title, contents) VALUES(?, ?, ?)");
  //$stmt->bind_param("sss", $username, $title, $contents);
  
  $stmt->execute();
  // }

  $stmt->close();
  $conn->close();

  echo outmsg(COMMIT_CODE);
  echo "<a href='./board_list.php'>게시판 목록</a>";

} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인화면으로</a>";
}
?>