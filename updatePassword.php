<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

$oldPassword_hash = hash("sha256", $oldPassword);
$newPassword_hash = hash("sha256", $newPassword);

// 클라이언트에서 전달받은 이메일과 비밀번호 값이 동일한 DB 정보를 선택하라는 명령
// $sql = "SELECT * FROM userInfo WHERE seq = '$userSeq' AND userPassword = '$oldPassword_hash'";
$sql = "SELECT COUNT(seq) FROM userInfo WHERE seq = '$userSeq' AND userPassword = '$oldPassword_hash'";
$result = mysqli_query($conn, $sql);
$exist = mysqli_fetch_array($result);

if ($exist['0'] == 1) {
    $sql2 = "UPDATE userInfo SET userPassword = '$newPassword_hash' WHERE seq = '$userSeq'";
    $result2 = mysqli_query($conn, $sql2);
    if($result2) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "0";
}
mysqli_close($conn);

?>
