<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$moimSeq = $_POST["moimSeq"];

// $userSeq = '98';
// $moimSeq = '41';

$sql = "SELECT COUNT(seq) 
        FROM member
        WHERE moimSeq = '$moimSeq'
        AND userSeq = '$userSeq'
        ";
$result = mysqli_query($conn, $sql);


// 모임의 leaderSeq 값 얻기
$sql2 = "SELECT leaderSeq FROM moim WHERE seq = '$moimSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$leaderSeq = $row2[0];


$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : meetupData, meetupTime, address, meetupSeq, moimSeq
$row = mysqli_fetch_array($result);
// print_r($row[0]);
$arr["memberCheck"] = $row[0];
$arr["leaderSeq"] = $leaderSeq;


echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
