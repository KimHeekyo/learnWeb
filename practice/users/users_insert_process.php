<?php
require "../util/db.php";

$username = $_POST['username'];
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$phone_num = $_POST['phone_num'];
$email = $_POST['email'];

$regist_err = FALSE;
$err_msg = "";

if ($password != $cpassword) {
    echo outmsg(DIFF_PASSWD);
    $regist_err = TRUE;
} else {
    $sql = "SELECT username FROM users WHERE username = '" . $username . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo outmsg(EXIST_USERNAME);
        $regist_err = TRUE;
    } else {
        $stmt = $conn->prepare("INSERT INTO users(username, nickname, password, phone_num, email) VALUES (?, ?, sha2(?,256), ?, ?)");
        $stmt->bind_param("sssss", $username, $nickname, $password, $phone_num, $email);
        $stmt->execute();
    }
}

$conn->close();

if ($regist_err) {
    echo "<a href='./users_insert.php'>회원가입</a>";
} else {
?>
<script>
    alert("회원가입이 완료되었습니다.");
    location.href='../main.php';
</script>
<?php
}
?>  