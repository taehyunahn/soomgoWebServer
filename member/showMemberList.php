<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$moimSeq = $_POST["moimSeq"];
// $moimSeq = '42';

// member 테이블과 userInfo 테이블을 결합한다 → moimSeq에 해당하는 행만 선택한다.
$sql = "SELECT *
        FROM member 
        LEFT JOIN userInfo ON member.userSeq = userInfo.seq 
        WHERE moimSeq = '$moimSeq'";
$result = mysqli_query($conn, $sql);

// moimSeq에 해당하는 모임의 leaderSeq(모임 개설자) 값을 얻는다.
$sql2 = "SELECT leaderSeq FROM moim WHERE seq = '$moimSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$leaderSeq = $row2[0];

$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : userProfileImage, leaderSeq, userName, userIntro, userStatus(생략)
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "userProfileImage" => $row['userProfileImage'],
        "userName" => $row['userName'],
        "userIntro" => $row['userIntro'],
        "userSeq" => $row['userSeq'],
        "leaderSeq" => $leaderSeq
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
