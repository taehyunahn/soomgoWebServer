<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결


$meetupSeq = $_POST["meetupSeq"]; 

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수


// 1. moim 테이블에서 moimSeq가 일치하는 행 삭제
// 2. member 테이블에서 moimSeq 칼럼이 moimSeq와 일치하는 행 모두 삭제

$sql = "DELETE FROM meetup WHERE seq = '$meetupSeq'";

if ($conn->query($sql) === TRUE) {
    $message = "Successfully 정모 삭제";
    $success = "1"; // 성공한 경우 1 전달

    // 정모 참석자 전부 삭제
    $sql2 = "DELETE FROM meetupMember WHERE meetupSeq = '$meetupSeq'";
    $result2 = mysqli_query($conn, $sql2);

} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}


// $updatedMyRoom_id = str_replace($currentRoom_id, "", $currentMyRoom_id);


$conn -> close();

$response["message"] = $message;

echo json_encode($response, JSON_UNESCAPED_UNICODE);







?>


