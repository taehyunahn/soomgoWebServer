<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$boardSeq = $_POST["boardSeq"];
$userSeq = $_POST["userSeq"];

// likeBoard 테이블에 boardSeq userSeq 값을 넣은 행을 추가한다
$sql = "DELETE FROM likeBoard 
        WHERE boardSeq = '$boardSeq' 
        AND userSeq = '$userSeq'";
$result = mysqli_query($conn, $sql);
if($result){
    $success = '1';
} else {
    $success = '0';
}

// likeBoard 테이블에 boardSeq 해당하는 개수를 구한다
$sql2 = "SELECT COUNT(seq) FROM likeBoard WHERE boardSeq = '$boardSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$likeCount = $row2[0];

$arr = array(); // 배열 생성


$arr["success"] = $success;
$arr["likeCount"] = $likeCount;


echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
