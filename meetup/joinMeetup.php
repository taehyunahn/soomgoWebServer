<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$moimSeq = $_POST["moimSeq"]; //
$userSeq = $_POST["userSeq"];
$meetupSeq = $_POST["meetupSeq"];

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

$sql = "INSERT INTO meetupMember (moimSeq, userSeq, meetupSeq) 
                    VALUES ('$moimSeq', '$userSeq', '$meetupSeq')";

if ($conn->query($sql) === TRUE) {
    $message = "Successfully 모임 목록에서 추가";
    $success = "1"; // 성공한 경우 1 전달

} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}

$conn -> close();

$response["message"] = $message;
$response["success"] = $success;

echo json_encode($response, JSON_UNESCAPED_UNICODE);







?>



