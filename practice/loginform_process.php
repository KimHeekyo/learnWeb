<?php

session_start();

require_once "./util/db.php";

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$userip = get_client_ip();

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? and password = sha2(?,256)");
$stmt -> bind_param("ss", $username, $password);

$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_array($result);

if (!empty($row['username'])) {
    echo outmsg(LOGIN_SUCCESS);
    echo outmsg('SESSION_CREATE');
    if(isset($_REQUEST['checkbox'])) {
        $a = setcookie('username', $username, time() + 60);
        $b = setcookie('password', $password, time() + 60);
    }
    $_SESSION['username'] = $username;
    $_SESSION['userip'] = $userip;

    $conn->close();
    header('Location: main.php');
} else {
    // echo outmsg(LOGIN_FAIL);
    // $conn->close();
    // // echo "<a href='../main.php'>메인화면으로</a>";
    // header('Location: main.php');
?>
<script>
    alert("로그인에 실패하였습니다");
    location.href='main.php';
</script>
<?php
}
?>