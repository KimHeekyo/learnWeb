<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list</title>
</head>
<body>
    <?php

    $records_per_page = 10;
    // 처음 page_no 없이 list할 때는 page_no 기본값을 1로하고,
    // page_no를 GET으로 받아올 수 있으면 받아온 값을 page_no로 대입
    // isset = null이 아닌 값이 있는경우 (값이 있다는 뜻)
    if(isset($_GET['page_no']) && $_GET['page_no'] != '') {
        $page_no = $_GET['page_no'];
    }else {
        $page_no = 1;
    }
    
        // 데이터베이스 연결하고
        // 테이블 조회 후 결과를 resultset에 보관
        $conn = new mysqli("localhost", "remind", "remind", "remind");
        // 페이지 offset 계산, 앞/뒤 페이지 이동 변수 선언
        $offset = ($page_no - 1) * $records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        // 전체 페이지 수 계산
        $sql = "SELECT COUNT(*) AS total_records FROM employee";
        $result = $conn->query($sql);
        $row = $result->fetch_array();
        $total_records = $row['total_records'];
        // ceil 올림
        $total_no_of_pages = ceil($total_records / $records_per_page);
        $page_range_size = 5;
        // floor 내림
        // 10, 20 등 page_range_size 크기의 페이지에서 그 다음 페이지가 페이지리스트의 시작하는 것을 방지하기 위함
        if(($page_no % $page_range_size) != 0){
        $start_page = floor($page_no / $page_range_size) * $page_range_size + 1;
        }else {
            $start_page = floor($page_no / $page_range_size) * $page_range_size + 1 - $page_range_size;
        }
        $end_page = $start_page + ($page_range_size - 1);

        if($end_page > $total_no_of_pages) {
            $end_page = $total_no_of_pages;
        }





        // $sql = "SELECT * FROM employee LIMIT 10, 10";
        $sql = "SELECT * FROM employee LIMIT ".$offset. ", ".$records_per_page;
        $resultset = $conn->query($sql);
    ?>
    <h1>인사정보 리스트</h1>

    <table>
        <tr>
            <th>No.</th>
            <th>성명</th>
            <th>사원번호</th>
            <th>전화번호</th>
            <th>입사일</th>
            <th>부서코드</th>
            <th>주소</th>
            <th>이메일</th>
        </tr>
<?php
    while($row = $resultset->fetch_assoc()){
?>
        <tr>
            <td><?=$row['id']?></td>
            <td><a href="detailview.php?id=<?=$row['id']?>"><?=$row['emp_name']?></a></td>
            <td><?=$row['emp_number']?></td>
            <td><?=$row['emp_phone']?></td>
            <td><?=$row['emp_hiredate']?></td>
            <td><?=$row['emp_deptcode']?></td>
            <td><?=$row['emp_address']?></td>
            <td><?=$row['emp_email']?></td>
        </tr>
<?php
    }
?>
    </table>
<?php
    echo "현재 페이지 : $page_no / $total_no_of_pages <br>";

    if($page_no > 1) {
        echo "<a href='list.php?page_no=1'>처음으로</a>&nbsp;&nbsp;&nbsp;";
    }
    if($page_no > 1) {
        echo "<a href='list.php?page_no=$previous_page'>이전페이지</a>&nbsp;&nbsp;&nbsp;";
    }

    for($count = $start_page; $count<=$end_page; $count++) {
        // echo "<a href='list.php?page_no=".$count."'>".$count."</a>&nbsp;&nbsp;&nbsp;";
        echo "<a href='list.php?page_no=$count'>$count</a>&nbsp;&nbsp;&nbsp;";
    }

    if($page_no < $total_no_of_pages) {
        echo "&nbsp;&nbsp;&nbsp;<a href='list.php?page_no=$next_page'>다음페이지</a>";
    }
    if($page_no < $total_no_of_pages) {
        echo "&nbsp;&nbsp;&nbsp;<a href='list.php?page_no=$total_no_of_pages'>끝으로</a>";
    }
?>

    <br>
    <a href="insert.php">New</a>
<?php
    $resultset->close();
    $conn->close();
?>
</body>
</html>