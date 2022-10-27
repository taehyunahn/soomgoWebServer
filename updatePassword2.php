<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userEmail = $_POST['userEmail'];
$newPassword = $_POST['newPassword'];

$newPassword_hash = hash("sha256", $newPassword);

// 클라이언트에서 전달받은 이메일과 비밀번호 값이 동일한 DB 정보를 선택하라는 명령
// $sql = "SELECT * FROM userInfo WHERE seq = '$userSeq' AND userPassword = '$oldPassword_hash'";
$sql = "SELECT COUNT(seq) FROM userInfo WHERE userEmail = '$userEmail'";
$result = mysqli_query($conn, $sql);
$exist = mysqli_fetch_array($result);

$result3 = array();
// $result3['data'] = array();
$sql3 = "SELECT * FROM userInfo WHERE userEmail = '$userEmail'";
$response = mysqli_query($conn, $sql3);


if ($exist['0'] == 1) {
    $sql2 = "UPDATE userInfo SET userPassword = '$newPassword_hash' WHERE userEmail = '$userEmail'";
    $result2 = mysqli_query($conn, $sql2);
    if($result2) { // 된 경우
        
        $arr = array(); // 배열 생성


        while($row = mysqli_fetch_array($response)){

        $result_array = array(
         "userSeq" => $row['seq'],
         "userName" => $row['userName'],
         "success"  => 1
        );
        $arr = $result_array;

        }
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);

    } else {
        echo "0"; //안된경우
    }
} else {
    echo "0"; //안된경우
}
mysqli_close($conn);

?>
