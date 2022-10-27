<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$boardSeq = $_POST["boardSeq"];
$response = array();

$sql = "SELECT imageUrl, boardSeq FROM board 
        LEFT JOIN imagesBoard ON board.seq = imagesBoard.boardSeq
        WHERE boardSeq = '$boardSeq'"; //모든 모임 조회


// case 1. 모든 모임 조회
// case 2. 모임의 interest가 현재 선택한 category와 일치 + 로그인 정보의 주소와 모임의 지역 일치하는 목록

$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성


// 게시글에 대한 정보를 클라이언트에 보낸다
// 1. 작성자 프로필 사진, 2. 게시글 작성일시, 3. 게시글 제목, 4. 게시글 내용
// 5. 좋아요 합계, 6. 댓글 합계
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "imageUrl" => $row['imageUrl']
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
