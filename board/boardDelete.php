<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결


$boardSeq = $_POST["boardSeq"]; 
$userSeq = $_POST["userSeq"]; 

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

// 게시글 삭제
$sql = "DELETE FROM board WHERE seq = '$boardSeq'";

if ($conn->query($sql) === TRUE) {
    $message = "게시글 삭제 완료";
    $success = "1"; // 성공한 경우 1 전달

    // 게시글 전부 삭제
    $sql3 = "DELETE FROM comment WHERE boardSeq = '$boardSeq'";
    $result3 = mysqli_query($conn, $sql3);
    // 좋아요 전부 삭제
    $sql4 = "DELETE FROM likeBoard WHERE boardSeq = '$boardSeq'";
    $result4 = mysqli_query($conn, $sql4);
    // 게시글 관련 이미지 전부 삭제
    $sql5 = "DELETE FROM imagesBoard WHERE boardSeq = '$boardSeq'";
    $result5 = mysqli_query($conn, $sql5);
    

} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}


// $updatedMyRoom_id = str_replace($currentRoom_id, "", $currentMyRoom_id);


$conn -> close();

$response["message"] = $message;
$response["success"] = $success;

echo json_encode($response, JSON_UNESCAPED_UNICODE);







?>


