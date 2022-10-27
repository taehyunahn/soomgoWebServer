<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$moimSeq = $_POST["moimSeq"];
$userSeq = $_POST["userSeq"];


// 채팅방에 참여한 날짜 구하기
$sql2 = "SELECT date
        FROM member 
        WHERE moimSeq = '$moimSeq'
        AND userSeq = '$userSeq'
        ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$joinedDate = $row2[0];


// member 테이블과 userInfo 테이블을 결합한다 → moimSeq에 해당하는 행만 선택한다.
$sql = "SELECT *
        FROM chatMsg 
        WHERE moimSeq = '$moimSeq'
        AND date >= '$joinedDate'
        ";
$result = mysqli_query($conn, $sql);

// // moimSeq에 해당하는 모임의 leaderSeq(모임 개설자) 값을 얻는다.
// $sql2 = "SELECT leaderSeq FROM moim WHERE seq = '$moimSeq'";
// $result2 = mysqli_query($conn, $sql2);
// $row2 = mysqli_fetch_array($result2);
// $leaderSeq = $row2[0];

$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : 
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "date" => $row['date'],
        "msg" => $row['msg'],
        "userName" => $row['userName'],
        "userProfileImage" => $row['userProfileImage'],
        "moimSeq" => $row['moimSeq'],
        "viewType" => $row['viewType'], 
        "userSeq" => $row['userSeq']
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
