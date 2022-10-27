<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$albumSeq = $_POST["albumSeq"];
$userSeq = $_POST["userSeq"];


// album 테이블에서 moimSeq에 해당되는 행을 선택한다
$sql = "SELECT userProfileImage, userName, imageUrl, album.date AS albumDate, album.userSeq AS uploaderSeq
        FROM album LEFT JOIN userInfo ON album.userSeq = userInfo.seq
        WHERE album.seq = '$albumSeq'";
$result = mysqli_query($conn, $sql);

// likeAlbum 테이블에 albumSeq에 해당하는 개수를 구한다
$sql2 = "SELECT COUNT(seq) FROM likeAlbum WHERE albumSeq = '$albumSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$likeCount = $row2[0];

// likeAlbum 테이블에 albumSeq와 userSeq에 해당하는 개수를 구한다 -> 해당 사진에 좋아요 클릭 여부 확인
$sql3 = "SELECT COUNT(seq) FROM likeAlbum WHERE albumSeq = '$albumSeq' AND userSeq = '$userSeq'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);
$likeClicked = $row3[0];

// comment 테이블에 albumSeq에 해당하는 개수를 구한다 -> 해당 사진에 좋아요 클릭 여부 확인
$sql4 = "SELECT COUNT(seq) FROM comment WHERE albumSeq = '$albumSeq'";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_array($result4);
$commentCount = $row4[0];


$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : profileImage, name, imageUrl, date 
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "profileImage" => $row['userProfileImage'],
        "name" => $row['userName'],
        "imageUrl" => $row['imageUrl'],
        "date" => $row['albumDate'],
        "uploaderSeq" => $row['uploaderSeq'],
        "likeCount" => $likeCount,
        "likeClicked" => $likeClicked,
        "commentCount" => $commentCount

    );
    $arr = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
