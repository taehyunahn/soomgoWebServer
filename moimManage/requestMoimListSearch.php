<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$inputSearch = $_POST["inputSearch"];
$category = "";

$response = array();

// // // 이미지 파일의 서버 경로, 고수고유값, 회원고유값을 저장한다.
if(empty($_POST["category"])){
    
    $sql = "SELECT * FROM moim
            WHERE title LIKE '%$inputSearch%'
            "; //모든 모임 조회
} else {
    $category = $_POST["category"];
    $sql = "SELECT * FROM moim 
            WHERE interest = '$category'
            AND title LIKE '%$inputSearch%'
            "; //모든 모임 조회
}

// case 1. 모든 모임 조회
// case 2. 모임의 interest가 현재 선택한 category와 일치 + 로그인 정보의 주소와 모임의 지역 일치하는 목록

$response = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

while ($row = mysqli_fetch_array($response)) {

    $moimSeq = $row['seq'];
    // 모임에 해당하는 멤버수 확인
    $sql3 = "SELECT COUNT(seq) FROM member WHERE moimSeq = '$moimSeq'"; 
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $joinedCount = $row3[0];

    $result_array = array(
        "mainImage" => $row['mainImage'],
        "address" => $row['address'],
        "title" => $row['title'],
        "memberCount" => $row['memberCount'],
        "moimSeq" => $row['seq'],
        "interest" => $row['interest'],
        "joinedCount" => $joinedCount
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
