<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$albumSeq = $_POST["albumSeq"];
$userSeq = $_POST["userSeq"];
$commentInput = $_POST["commentInput"];

// comment 테이블에 albumSeq와 userSeq, commentInput값을 넣은 행을 추가한다
$sql = "INSERT INTO comment (albumSeq, userSeq, commentInput) VALUES ('$albumSeq', '$userSeq', '$commentInput')";
$result = mysqli_query($conn, $sql);
if($result){
    $success = '1';
} else {
    $success = '0';
}

// likeAlbum 테이블에 albumSeq에 해당하는 개수를 구한다
$sql2 = "SELECT COUNT(seq) FROM comment WHERE albumSeq = '$albumSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$commentCount = $row2[0];


$sql4 = "SELECT userSeq FROM album WHERE seq = '$albumSeq'";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_array($result4);
$uploaderSeq = $row4[0];

$sql5 = "SELECT moimSeq FROM album WHERE seq = '$albumSeq'";
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_array($result5);
$moimSeq = $row5[0];

$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : userProfileImage, userName, userSeq, commentInput, albumSeq, commentDate, commentSeq, success 
$sql3 = "SELECT userProfileImage, userName, userSeq, commentInput, albumSeq, comment.date AS commentDate, comment.seq AS commentSeq
         FROM comment 
         LEFT JOIN userInfo ON comment.userSeq = userInfo.seq
         WHERE albumSeq = '$albumSeq'";
$result3 = mysqli_query($conn, $sql3);

while($row3 = mysqli_fetch_array($result3)){
    $result_array = array(
        "userProfileImage" => $row3['userProfileImage'],
        "userName" => $row3['userName'],
        "userSeq" => $row3['userSeq'],
        "commentInput" => $row3['commentInput'],
        "albumSeq" => $row3['albumSeq'],
        "commentDate" => $row3['commentDate'],
        "commentSeq" => $row3['commentSeq'],
        "success" => $success,
        "uploaderSeq" => $uploaderSeq,
        "moimSeq" => $moimSeq
        
    );
    $arr = $result_array;
}

// $arr["success"] = $success;

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
