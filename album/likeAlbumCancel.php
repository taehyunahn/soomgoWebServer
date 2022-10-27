<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$albumSeq = $_POST["albumSeq"];
$userSeq = $_POST["userSeq"];

// likeAlbum 테이블에 albumSeq와 userSeq 값을 넣은 행을 추가한다
$sql = "DELETE FROM likeAlbum 
        WHERE albumSeq = '$albumSeq' 
        AND userSeq = '$userSeq'";
$result = mysqli_query($conn, $sql);
if($result){
    $success = '1';
} else {
    $success = '0';
}

// likeAlbum 테이블에 albumSeq에 해당하는 개수를 구한다
$sql2 = "SELECT COUNT(seq) FROM likeAlbum WHERE albumSeq = '$albumSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$likeCount = $row2[0];

$arr = array(); // 배열 생성


$arr["success"] = $success;
$arr["likeCount"] = $likeCount;


echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
