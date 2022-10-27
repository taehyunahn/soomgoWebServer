<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$boardSeq = $_POST["boardSeq"];
$userSeq = $_POST["userSeq"];
$commentInput = $_POST["commentInput"];

// comment 테이블에 albumSeq와 userSeq, commentInput값을 넣은 행을 추가한다
$sql = "INSERT INTO comment (boardSeq, userSeq, commentInput) VALUES ('$boardSeq', '$userSeq', '$commentInput')";
$result = mysqli_query($conn, $sql);
if($result){
    $success = '1';
} else {
    $success = '0';
}

// likeAlbum 테이블에 albumSeq에 해당하는 개수를 구한다
$sql2 = "SELECT COUNT(seq) FROM comment WHERE boardSeq = '$boardSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$commentCount = $row2[0];

$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : userProfileImage, userName, userSeq, commentInput, albumSeq, commentDate, commentSeq, success 
$sql3 = "SELECT userProfileImage, userName, userSeq, commentInput, boardSeq, comment.date AS commentDate, comment.seq AS commentSeq
         FROM comment 
         LEFT JOIN userInfo ON comment.userSeq = userInfo.seq
         WHERE boardSeq = '$boardSeq'";
$result3 = mysqli_query($conn, $sql3);

while($row3 = mysqli_fetch_array($result3)){
    $result_array = array(
        "userProfileImage" => $row3['userProfileImage'],
        "userName" => $row3['userName'],
        "userSeq" => $row3['userSeq'],
        "commentInput" => $row3['commentInput'],
        "boardSeq" => $row3['boardSeq'],
        "commentDate" => $row3['commentDate'],
        "commentSeq" => $row3['commentSeq'],
        "success" => $success
        
    );
    $arr = $result_array;
}

// $arr["success"] = $success;

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
