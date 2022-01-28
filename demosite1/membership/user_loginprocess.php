<!-- 
  파일명 : user_loginprocess.php
  최초작업자 : swcodingschool
  최초작성일자 : 2022-1-3
  업데이트일자 : 2022-1-3
  
  기능: 
  user_login.php 로그인 화면에서 입력된 값을 받아 
  유저명과 비밀번호를 확인, 등록된 사용자임을 확인한다.
-->

<?php
// 여기부터는 로그인 성공시 세션관리를 위한 코드 추가
// 세션을 핸들링 할 때는 가장 앞에 와야함
session_start();
// db연결 준비
require_once "../util/dbconfig.php";

// 데이터베이스 작업 전, 로그인 화면으로 부터 값을 전달 받고
//$username = $_POST['username'];
//$passwd = $_POST['passwd'];
//REQUEST는 GET과 POST방식을 다 받을 수 있는 넓은 바구니 느낌
$username = $_REQUEST['username'];
$passwd = $_REQUEST['passwd'];
// 세션관리를 위하여 클라이언트 정보 수집
$userip = get_client_ip();

// 사용자 계정 존재 여부 확인을 위한 질의 구성
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? and passwd = sha2(?,256)");
$stmt->bind_param("ss", $username, $passwd);

$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_array($result);

if (!empty($row['username'])) {
  echo outmsg(LOGIN_SUCCESS);
  // 여기부터 로그인 성공시 세션관리를 위한 추가 코드
  //session_start();
  echo outmsg('SESSION_CREATE');
  //echo outmsg($userip);
  //쿠키는 브라우저가 허용을 해줘야함
  if(isset($_REQUEST['chkbox'])){
    $a = setcookie('username', $username, time() + 60);
    $b = setcookie('passwd', $passwd, time() + 60);
  }
  $_SESSION['username']=$username;
  $_SESSION['userip']=$userip;
  // 여기까지 로그인 성공시 세션관리를 위한 추가 코드
  $conn->close();
  //header('Location: user_list.php');
  echo "<a href='user_userlist.php'>목록보기</a>";
} else {
  echo outmsg(LOGIN_FAIL);
  $conn->close();
  //header('Location: index.php');
  echo "<a href='../index.php'>메인화면으로</a>";
}


?>