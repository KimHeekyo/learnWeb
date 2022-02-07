<?php

require "../util/db.php";

require_once "../util/login.php";

if($chk_login) {
$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id =" . $id;

if ($conn->query($sql) == TRUE) {
    ?>
    <script>
        alert("회원탈퇴가 완료되었습니다.");
        location.href='../main.php';
    </script>
<?php
unset($_SESSION["username"]);
unset($_SESSION["userip"]);

} else {
echo outmsg(DELETE_FAIL);
}

$conn->close();

}else {
    echo outmsg(LOGIN_NEED);
}
?>