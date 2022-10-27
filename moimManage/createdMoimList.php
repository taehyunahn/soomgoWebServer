<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>
<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

// $userSeq = '92';
$userSeq = $_POST["userSeq"];

// $current_page  = $_POST["page"];
// $page_per_item  = $_POST["limit"];

// $start_item = ($current_page - 1) * $page_per_item;

$arr = array();

$sql = "SELECT * FROM moim WHERE leaderSeq = '$userSeq'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){

    $moimSeq = $row['seq'];

    // 모임에 참여중인 멤버수 확인
    $sql3 = "SELECT COUNT(seq) FROM member WHERE moimSeq = '$moimSeq'"; 
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $joinedCount = $row3[0];

    // 개설한 모임의 개수
    $sql4 = "SELECT COUNT(seq) FROM moim WHERE leaderSeq = '$userSeq'"; 
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_array($result4);
    $itemCount = $row4[0];

    $result_array = array(
        "mainImage" => $row['mainImage'],
        "address" => $row['address'],
        "title" => $row['title'],
        "memberCount" => $row['memberCount'],
        "moimSeq" => $row['seq'],
        "interest" => $row['interest'],
        "joinedCount" => $joinedCount,
        "itemCount" => $itemCount
    );
    $arr[] = $result_array;
}


echo json_encode($arr, JSON_UNESCAPED_UNICODE);

?>
