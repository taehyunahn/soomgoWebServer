<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userEmail = $_POST['userEmail'];

// 클라이언트에서 전달받은 이메일과 비밀번호 값이 동일한 DB 정보를 선택하라는 명령
$sql = "SELECT * FROM userInfo WHERE userEmail = '$userEmail'";
$result = mysqli_query($conn, $sql);

// //
// $sql2 = "SELECT * FROM userInfo WHERE userEmail IN ('$userEmail')";
// $result2 = mysqli_query($conn, $sql2);

// print_r($arr);

$arr = array();
$arr["success"] = true;

while($row = mysqli_fetch_array($result)) {

    $result_array = array(
        "success" => false,
        "userEmail" => $row["userEmail"]
    );
    $arr = $result_array;


}
echo json_encode($arr, JSON_UNESCAPED_UNICODE);


mysqli_close($conn);

?>
