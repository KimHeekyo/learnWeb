<!-- 
  파일명 : oo_user_updateprocess.php
  최초작업자 : swcodingschool
  최초작성일자 : 2021-12-28
  업데이트일자 : 2021-12-28
  
  기능: 
  oo_user_update.php 사용자 정보 수정 화면에서 입력된 값을 받아, 
  users 테이블에 사용자 수정된 데이터를 업데이트 한다.
-->

<?php
  // db연결 준비
  require "../util/dbconfig.php";

  require_once '../util/loginchk.php';

  $upload_path = './uploadfiles/';

  if($chk_login){
  // 게시판 수정 화면으로 부터 값을 전달 받고
  $id = $_POST['id'];
  $username = $_POST['username'];
  $title = $_POST['title'];
  $contents = $_POST['contents'];
  $regtime = $_POST['regtime'];

  if(isset($_FILES['uploadfile']['tmp_name']) && ($_FILES['uploadfile']['tmp_name'] != "")) {

  $filename = $_FILES['uploadfile']['name'];
  $filename = time()."_".$_FILES['uploadfile']['name']; // 파일 중복 회피

  if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $upload_path.$filename)) {
    $sql = "SELECT * FROM board WHERE id =".$id;
    $resultset = $conn->query($sql);
    $row = $resultset->fetch_assoc();
    $existingfile = $row['uploadfile'];
    if(isset($existingfile) && $existingfile != "") {
      unlink($upload_path.$existingfile);
    }
  }
  

  
  // 업데이트 처리를 위한 prepared sql 구성 및 bind
  $stmt = $conn->prepare("UPDATE board SET title = ?, contents = ?, uploadfile =? WHERE id = ?" );
  $stmt->bind_param("ssss", $title, $contents, $filename, $id);
} else {
  $stmt = $conn->prepare("UPDATE board SET title = ?, contents = ? WHERE id = ?" );
  $stmt->bind_param("sss", $title, $contents, $id);
}
  $stmt->execute();

  // 데이터베이스 연결 인터페이스 리소스를 반납한다.
  $conn->close();

  // 프로세스 플로우를 메모내용 상세보기 페이지로 돌려준다.
  header('Location: board_detailview.php?id='.$id);
} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인화면으로</a>";
}
?>