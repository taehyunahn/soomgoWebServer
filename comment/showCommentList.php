<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$boardSeq = $_POST["boardSeq"];

// 댓글에 대한 정보 선택
$sql = "SELECT 
        userProfileImage, 
        userName, 
        userSeq, 
        commentInput, 
        boardSeq,
        comment.date AS commentDate,
        comment.seq AS commentSeq
        FROM comment 
        LEFT JOIN userInfo ON comment.userSeq = userInfo.seq
        WHERE boardSeq = '$boardSeq'";
$result = mysqli_query($conn, $sql);

// 댓글 합계 (boardSeq가 동일한)
// query문에서 값을 얻어내는 예시
$commentCountSql = "SELECT COUNT(seq) 
                    FROM comment
                    WHERE boardSeq = '$boardSeq'";
$commentCountResult = mysqli_query($conn, $commentCountSql);
$data = mysqli_fetch_array($commentCountResult);
$commentCount = $data[0];


$arr = array(); // 배열 생성


// 게시글에 대한 정보를 클라이언트에 보낸다
// 1. 작성자 프로필 사진, 2. 게시글 작성일시, 3. 게시글 제목, 4. 게시글 내용
// 5. 좋아요 합계, 6. 댓글 합계
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "userProfileImage" => $row['userProfileImage'],
        "userName" => $row['userName'],
        "userSeq" => $row['userSeq'], //작성자의 고유값
        "commentInput" => $row['commentInput'],
        "boardSeq" => $row['boardSeq'],
        "commentDate" => $row['commentDate'],
        "commentSeq" => $row['commentSeq'],
        "commentCount" => $commentCount
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
