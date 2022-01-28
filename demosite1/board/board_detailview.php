<!-- 
  파일명 : user_detailview.php
  최초작업자 : swcodingschool
  최초작성일자 : 2021-12-28
  업데이트일자 : 2021-12-28
  
  기능: 
  id를 GET방식으로 넘겨받아, 해당 id 레코드 정보를 검색,
  화면에 상세 정보를 뿌려준다.
-->
<?php
// db연결 준비
require "../util/dbconfig.php";

// 로그인한 상태일 때만 이 페이지 내용을 확인할 수 있다.
require_once '../util/loginchk.php';

if($chk_login){
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
  <h1 style="text-align:center; padding: 50px;">게시물 내용</h1>
  <br>
  <?php

  $id = $_GET['id'];

  $upload_path = './uploadfiles/';

  $sql = "SELECT * FROM board WHERE id = " . $id;
  $resultset = $conn->query($sql);

  if ($resultset->num_rows > 0) {
  $row = $resultset->fetch_assoc();
  ?>
    <table align='center'>
      <tr>
        <th width='50'>번호</th>
        <th width='150'>제목</th>
        <th width='300'>내용</th>
        <th width='100'>작성자</th>
        <th width='200'>작성일</th>
        <th width='200'>최종수정시간</th>
        <th width='80'>조회수</th>
        <th width='300'>첨부파일</th>
      </tr>

    <tr>
      <td align='center'><?=$row['id']?></td>
      <td align='center'><?=$row['title']?></td>
      <td align='center'><?=$row['contents']?></td>
      <td align='center'><?=$row['username']?></td>
      <td align='center'><?=$row['regtime']?></td>
      <td align='center'><?=$row['lasttime']?></td>
      <td align='center'><?=$row['hit']?></td>
      <td align='center'>
      <img src='<?= $upload_path.$row['uploadfile'] ?>' alt='이미지가 없습니다.' width='200px' height='auto'>
      </td>
    </tr>
    </table>
  
  <!-- 댓글 작성창 -->
<?php
 $sql2 = "SELECT * FROM comment WHERE bonum = " . $id;
  $resultset = $conn->query($sql2);
  $row = $resultset->fetch_assoc();
?>

  <form action="./comment_write.php" method="POST">
    <h3>댓글창 테스트</h3>
    <input type="hidden" name="conum" value="<?=$row['conum']?>">
    <input type="hidden" name="bonum" value="<?=$row['bonum']?>">
    <textarea style="width:500px;" name="contents"></textarea>
    <input type="submit" value="작성하기">
  </form>

  <!-- 댓글 불러오기 -->
  <?php
  while ($row = $resultset->fetch_assoc()) {
  ?>
    <table align='center'>
      <tr>
        <th width='300'>작성자</th>
        <th width='100'>댓글내용</th>
        <th width='200'>작성일</th>
      <tr>

      <tr>
      <td align='center'><?=$row['username']?></td>
      <td align='center'><?=$row['contents']?></td>
      <td align='center'><?=$row['regtime']?></td>
      </tr>
  <?php
  }
  ?>
    </table>


  <!-- 조회수를 주기위한 php 변수 -->
  <?php
  $sql = "UPDATE board SET hit = hit + 1 WHERE id =".$id;
  $resultset = $conn->query($sql);
  ?>
  <div style= "text-align:center; padding-top: 50px; font-size:20px;">
    <a href="board_update.php?id=<?=$row['id']?>" >수정</a>  
    <a href="board_deleteprocess.php?id=<?=$row['id']?>">삭제</a>
  </div>
  <?php
  }
  ?>
  <br>

  

  <div style= "text-align:center; font-size:20px;">
    <a href="board_list.php">목록보기</a>
  </div>
</body>
<?php 
  $conn->close();
}else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인화면으로</a>";
}
?>
</html>