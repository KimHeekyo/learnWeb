<?php 
include '../util/dbconfig.php';

require_once '../util/loginchk.php';
if($chk_login) {
$username = $_SESSION['username'];
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" href="../css/listcss.css">
</head>
<body>
<body>
<div class='hd'>
    <div>
    <a href="../board/board_list.php" style="float: left;">뒤로가기</a>
    </div>
    <div style="float: right; font-size:20px;">
    <?=$username?>님
    </div>
</div>
    <h1 style="text-align:center">게시판</h1>
<br><br>

<?php
if(isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$category = $_GET['category'];
$keyword = $_GET['keyword'];

$total_records_per_page = 10;

$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$sql = "SELECT COUNT(*) AS total_records FROM board WHERE ". $category. " like '%".$keyword. "%'";
$resultset = $conn->query($sql);
// $result = mysqli_fetch_array($resultset);
$result = $resultset->fetch_array();
$total_records = $result['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;

?>

<div class='tblwrapper'> 

<?php


if($category=='title'){
    $catname = '제목';
} else if($category=='username'){
    $catname = '작성자';
} else if($category=='contents'){
    $catname = '내용';
}
echo "<h3>'$keyword' 의 검색결과</h3>";
?>

<?php

// $sql = "select * from board where ". $category. " like '%".$keyword. "%' order by id desc";
// $resultset = $conn->query($sql);

$sql = "SELECT * FROM board WHERE ". $category. " like '%".$keyword. "%' LIMIT ".$offset.", ".$total_records_per_page;
$resultset = $conn->query($sql);

echo
"<table>
    <tr>
        <th width='100'>번호</th>
        <th width='500'>제목</th>
        <th width='150'>작성자</th>
        <th width='500'>등록일</th>
        <th width='200'>조회수</th>
    </tr>";

while($row = $resultset->fetch_assoc()){
    echo
    "<tr>
        <td align='center'>".$row['id']."</td>
        <td align='center'><a href='./board_detailview.php?id=" .$row['id']. "'>".$row['title']."</a></td>
        <td align='center'>".$row['username']."</td>
        <td align='center'>".$row['regtime']."</td>
        <td align='center'>".$row['hit']."</td>
    </tr>";
}
?>
</table>
</div>

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

<ul class="pagination">
<?php

$page_range_size = 5;
$start_page = floor($page_no / $page_range_size)*$page_range_size + 1;
$end_page = $start_page + ($page_range_size - 1);

if($end_page > $total_no_of_pages) {
    $end_page = $total_no_of_pages;
}

if($page_no > 1){
echo "<li><a href='?page_no=1&category=$category&keyword=$keyword'>&laquo 처음으로</a></li>";
} ?>

<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
<a <?php if($page_no > 1){
echo "href='?page_no=$previous_page&category=$category&keyword=$keyword'";
} ?>>이전 페이지</a>
</li>
<?php

// for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
for ($counter = $start_page; $counter <= $end_page; $counter++){
	if ($counter == $page_no) {
	echo "<li class='active'><a>$counter</a></li>";	
    }else{
    echo "<li><a href='?page_no=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
    }
    }
?>

<li <?php if($page_no >= $total_no_of_pages){
echo "class='disabled'";
} ?>>
<a <?php if($page_no < $total_no_of_pages) {
echo "href='?page_no=$next_page&category=$category&keyword=$keyword''";
} ?>>다음 페이지</a>
</li>

<?php if($page_no < $total_no_of_pages){
echo "<li><a href='?page_no=$total_no_of_pages&category=$category&keyword=$keyword''>끝 페이지 &raquo;</a></li>";
} ?>
</ul>
</body>
<?php
} else {
  echo outmsg(LOGIN_NEED);
  echo "<a href='../index.php'>메인메뉴로</a>";
}
?>
</html>