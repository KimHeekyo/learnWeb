<!-- 
  파일명 : board_list.php
  최초작업자 : swcodingschool
  최초작성일자 : 2022-1-3
  업데이트일자 : 2022-1-3
  
  기능: 
  메모 목록 리스팅 기능을 수행하도록 구성함.
-->
<?php
// db연결 준비
require "../util/dbconfig.php";

// 로그인한 상태일 때만 이 페이지 내용을 확인할 수 있다.
require_once '../util/loginchk.php';
if($chk_login) {
  $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/listcss.css">
</head>

<body>
  <div class='hd'>
    <div>
    <a href="../index.php" style="float: left;">메인메뉴로</a>
    </div>
    <div style="float: right; font-size:20px;">
    <?=$username?>님
    </div>
  </div>
  <h1 style="text-align:center">게시판</h1>
  <br><br>
  <?php
  
  // ===========================================
  // 여기부터 pagination용 추가
  // 1. 페이지를 $_GET을 이용하여 전달 받는다. 없으면 현재 $page = 1이다.
  if(isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
  }

  // 2. 페이지당 보여줄 리스트 갯수값을 정한다.
  $total_records_per_page = 10;

  // 3. OFFSET을 계산하고 앞/뒤 페이지 등의 변수를 설정한다.
  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;


  // 4. 전체 페이지 수를 계산한다.
  $sql = "SELECT COUNT(*) AS total_records FROM board";
  $resultset = $conn->query($sql);
  // $result = mysqli_fetch_array($resultset);
  $result = $resultset->fetch_array();
  $total_records = $result['total_records'];
  $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1;
  // 여기까지 pagination용 추가
  //=================================================
  // 다음은 pagination을 위해 기존 코드 수정
  // $sql = "SELECT * FROM board";
  $sql = "SELECT * FROM board LIMIT ".$offset.", ".$total_records_per_page;
  $resultset = $conn->query($sql);
?>
<div class='tblwrapper'>
<?php
  if ($resultset->num_rows > 0) {
    echo "<table>
            <tr>
              <th width='100'>번호</th>
              <th width='500'>제목</th>
              <th width='150'>작성자</th>
              <th width='500'>등록일</th>
              <th width='200'>조회수</th>
            </tr>";
    // out data of each row
    while ($row = $resultset->fetch_assoc()) {
      echo
      "<tr>
        <td> ".$row['id']." </td>
        <td> <a href='./board_detailview.php?id=" .$row['id']. "'>".$row['title']."</a></td>
        <td>".$row['username']."</td>
        <td>".$row['regtime']."</td>
        <td>".$row['hit']."</td>
        </tr>";
    }
    echo "</table>";
  }
  //==================================== 
  //여기부터 pagination을 위해 추가 부분
?>
</div><!-- tblwrapper의 끝 -->

<div class="write">
  <!-- 검색바 -->
  <div id="search_box">
    <form action="search_result.php" method="GET">
      <select name="category">
        <option value="title">제목</option>
        <option value="username">작성자</option>
        <option value="contents">내용</option>
      </select>
      <input type="text" name="keyword" size="20" required="required">
      <button class="btn btn-primary">검색</button>
    </form>
  </div>
  <!-- 검색바끝 -->

  <div class="wb">
    <a href="./board_regist.php">글작성</a>
  </div>
</div>

<ul class="pagination">
  <?php

  
  $page_range_size = 5;
  $start_page = floor($page_no / $page_range_size)*$page_range_size + 1;
  $end_page = $start_page + ($page_range_size - 1);

  if($end_page > $total_no_of_pages) {
    $end_page = $total_no_of_pages;
  }
  
  if($page_no > 1){
  echo "<li><a href='?page_no=1'>&laquo 처음으로</a></li>";
  } ?>
      
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){
  echo "href='?page_no=$previous_page'";
  } ?>>이전 페이지</a>
  </li>
<?php
  
	// for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
  for ($counter = $start_page; $counter <= $end_page; $counter++){
	if ($counter == $page_no) {
	echo "<li class='active'><a>$counter</a></li>";	
	      }else{
        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                }
        }
?>

  <li <?php if($page_no >= $total_no_of_pages){
  echo "class='disabled'";
  } ?>>
  <a <?php if($page_no < $total_no_of_pages) {
  echo "href='?page_no=$next_page'";
  } ?>>다음 페이지</a>
  </li>

  <?php if($page_no < $total_no_of_pages){
  echo "<li><a href='?page_no=$total_no_of_pages'>끝 페이지 &raquo;</a></li>";
  } ?>
  </ul>
  <?php // 여기까지 pagination을 위해 추가 부분
  //=================================================
  ?>
</body>
<?php 
} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인메뉴로</a>";
}
?>
</html>