<!-- 
  파일명 : user_update.php
  최초작업자 : swcodingschool
  최초작성일자 : 2021-12-29
  업데이트일자 : 2021-12-29
  
  기능: 
  상세정보확인화면에서 수정을 클릭하였을 때 진행되는 코드
  전 단계에서 전달되 id 를 이용, 값을 수정한다. 
-->
<?php
// 연결 준비
require '../util/dbconfig.php';

// 로그인한 상태일 때만 이 페이지 내용을 확인할 수 있다.
require_once '../util/loginchk.php';

if($chk_login){
// 수정할 레코드의 id값을 받아온다.
$id = $_GET['id'];
// 해당 id로 데이터를 검색하는 질의문 구성
$sql = "SELECT * FROM memo WHERE id = ".$id;
// 해당 질의문 실행하여 결과 가져오기
$result = $conn->query($sql);
// 결과셋을 한 개의 행으로 처리하고,
// 필요로 하는 각 컬럼의 값을 얻어온다.
if ($result->num_rows > 0) {
  $row = $result->fetch_array();
  $username = $row['username'];
  $title = $row['title'];
  $contents = $row['contents'];
  $regtime = $row['regtime'];
  $lasttime = $row['lasttime'];
} else {
  echo outmsg(INVALID_MEMOID);// 게시글 번호가 잘못되었음을 출력하는 메시지 추가할 것!!
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>메모 수정</h1>
  <form action="memo_updateprocess.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>" />
    <label>작성자</label><input type="text" name="username" value="<?= $username ?>" readonly><br>
    <label>메모제목</label><input type="text" name="title" value="<?= $title ?>"><br>
    <label>메모내용</label><input type="text" name="contents" value="<?=$contents?>"><br>
    <label>최초작성</label><input type="text" name="regtime" value="<?=$regtime?>" readonly><br>
    <label>최종수정</label><input type="text" name="lasttime" value="<?= $lasttime?>" readonly><br>
    <br>
    <input type=submit value="수정">
  </form>
  <a href="memo_list.php">목록보기</a>
</body>
<?php 
}else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>인덱스페이지로</a>";
}
?>
</html>