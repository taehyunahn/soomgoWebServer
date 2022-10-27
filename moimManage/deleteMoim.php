<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결


$moimSeq = $_POST["moimSeq"]; 

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수


// 1. moim 테이블에서 moimSeq가 일치하는 행 삭제
// 2. member 테이블에서 moimSeq 칼럼이 moimSeq와 일치하는 행 모두 삭제

$sql = "DELETE FROM moim WHERE seq = '$moimSeq'";

if ($conn->query($sql) === TRUE) {
    $message = "Successfully 모임 목록에서 삭제";
    $success = "1"; // 성공한 경우 1 전달

    // 멤버 전부 삭제
    $sql2 = "DELETE FROM member WHERE moimSeq = '$moimSeq'";
    $result2 = mysqli_query($conn, $sql2);
    // 게시글 전부 삭제
    $sql3 = "DELETE FROM board WHERE moimSeq = '$moimSeq'";
    $result3 = mysqli_query($conn, $sql3);
    // 사진첩 전부 삭제
    $sql4 = "DELETE FROM album WHERE moimSeq = '$moimSeq'";
    $result4 = mysqli_query($conn, $sql4);
    // 채팅 메세지 전부 삭제
    $sql5 = "DELETE FROM chatMsg WHERE moimSeq = '$moimSeq'";
    $result5 = mysqli_query($conn, $sql5);

} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}


// $updatedMyRoom_id = str_replace($currentRoom_id, "", $currentMyRoom_id);


$conn -> close();

$response["message"] = $message;

echo json_encode($response, JSON_UNESCAPED_UNICODE);







?>


