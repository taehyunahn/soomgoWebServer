<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$moimSeq = $_POST["moimSeq"];
$userSeq = $_POST["userSeq"];

$response = array();

// board 테이블에서 moimSeq 칼럼이 $moimSeq와 일치하는 행 출력
$sql = "SELECT userName, title, content, board.date AS boardDate, userProfileImage, board.seq AS boardSeq
        FROM board 
        LEFT JOIN userInfo ON board.writerSeq = userInfo.seq
        WHERE moimSeq = '$moimSeq'"; 
$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

while ($row = mysqli_fetch_array($result)) {

    $boardSeq = $row['boardSeq'];
    // 게시글에 좋아요 개수 구하기
    $sql2 = "SELECT COUNT(seq) FROM likeBoard WHERE boardSeq = '$boardSeq'"; 
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $likeCount = $row2[0];
 
    // 게시글에 좋아요 개수 구하기
    $sql3 = "SELECT COUNT(seq) FROM comment WHERE boardSeq = '$boardSeq'"; 
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $commentCount = $row3[0];

    // 가장 최근에 등록된 사진 구하기
    $sql4 = "SELECT imageUrl, seq FROM imagesBoard WHERE boardSeq = '$boardSeq' ORDER BY seq DESC limit 1"; 
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_array($result4);
    $mainImageUrl = $row4[0];

    $result_array = array(
        "name" => $row['userName'],
        "title" => $row['title'],
        "content" => $row['content'],
        "date" => $row['boardDate'],
        "profileImage" => $row['userProfileImage'],
        "boardSeq" => $row['boardSeq'],
        "likeCount" => $likeCount,
        "commentCount" => $commentCount,
        "mainImageUrl" => $mainImageUrl,

    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
