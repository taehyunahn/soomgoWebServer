<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$userSeq = $_POST["userSeq"]; //
$albumSeq = $_POST["albumSeq"]; // 

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

$sql = "DELETE FROM album WHERE seq = '$albumSeq'";
if($conn->query($sql) === TRUE){
    $success = "1"; // 성공한 경우 1 전달

    $sql2 = "DELETE FROM comment WHERE albumSeq = '$albumSeq'";
    $conn->query($sql2);

} else {
$success = "0"; // 실패한 경우 0 전달
}

$conn -> close();

$response["success"] = $success;
echo json_encode($response);





?>


