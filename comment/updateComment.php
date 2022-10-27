<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$comment = $_POST["comment"]; //
// $boardSeq = $_POST["boardSeq"]; // 
$commentSeq = $_POST["commentSeq"]; 
// $albumSeq = $_POST["albumSeq"]; 

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

if(isset($_POST["boardSeq"])){ // 게시글 고유값이 null이 아니라면, (게시판에서 동작한 경우 해당)

    $sql = "UPDATE comment SET commentInput = '$comment'
    WHERE seq = '$commentSeq'";

    if ($conn->query($sql) === TRUE) {
    $success = "2"; // 성공한 경우 1 전달
    } else {
    $success = "0"; // 실패한 경우 0 전달
    }

}  else if(isset($_POST["albumSeq"])) { // 사진첩 고유값이 null이 아니라면, (게시판에서 동작한 경우 해당)

    $sql = "UPDATE comment SET commentInput = '$comment'
    WHERE seq = '$commentSeq'";

    if ($conn->query($sql) === TRUE) {
    $success = "1"; // 성공한 경우 1 전달
    } else {
    $success = "0"; // 실패한 경우 0 전달
    }

}




$conn -> close();

$response["success"] = $success;
// $response["albumSeq"] = $albumSeq;
echo json_encode($response);





?>


