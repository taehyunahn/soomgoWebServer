<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$albumSeq = $_POST["albumSeq"];


// likeAlbum 테이블에 albumSeq에 해당하는 개수를 구한다
$sql2 = "SELECT COUNT(seq) FROM comment WHERE albumSeq = '$albumSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$commentCount = $row2[0];

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
        "commentSeq" => $row3['commentSeq']
        
    );
    $arr[] = $result_array;
}

// $arr["success"] = $success;

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
