<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>
<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$meetupTitle = $_POST["meetupTitle"]; //
$address = $_POST["address"]; // 
$fee = $_POST["fee"]; // 
$meetupDate = $_POST["meetupDate"]; //
$meetupTime = $_POST["meetupTime"]; //
$userSeq = $_POST["userSeq"]; // 로그인 사용자 고유번호
$moimSeq = $_POST["moimSeq"]; //
$meetupSeq = $_POST["meetupSeq"]; //

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

$sql = "UPDATE meetup 
        SET meetupTitle = '$meetupTitle', address = '$address', fee = '$fee', meetupDate = '$meetupDate', meetupTime = '$meetupTime'
        WHERE seq = '$meetupSeq'";

if ($conn->query($sql) === TRUE) {
$message = "Successfully meetup updated";
$success = "1"; // 성공한 경우 1 전달
} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}

$conn -> close();

$response["moimSeq"] = $moimSeq;
$response["message"] = $message;
$response["success"] = $success;
echo json_encode($response);


?>


