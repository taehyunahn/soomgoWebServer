<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$meetupTitle = $_POST["meetupTitle"]; //
$address = $_POST["address"]; // 
$fee = $_POST["fee"]; // 
$memberCount = $_POST["memberCount"]; //
$meetupDate = $_POST["meetupDate"]; //
$meetupTime = $_POST["meetupTime"]; //
$userSeq = $_POST["userSeq"]; // 로그인 사용자 고유번호
$moimSeq = $_POST["moimSeq"]; //

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

$sql = "INSERT INTO meetup (meetupTitle, address, fee, memberCount, meetupDate, meetupTime, moimSeq) 
                    VALUES ('$meetupTitle', '$address', '$fee', '$memberCount', '$meetupDate', '$meetupTime', '$moimSeq')";

// $sql = "INSERT INTO meetup (meetupTitle, address, fee, memberCount, moimSeq) 
//                     VALUES ('$meetupTitle', '$address', '$fee', '$memberCount', '$moimSeq')";



if ($conn->query($sql) === TRUE) {
$last_id = mysqli_insert_id($conn); // 방금 생성한 데이터의 고유값(seq)을 변수에 담는다. -> 모임의 고유값
$message = "Successfully Uploaded";
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


