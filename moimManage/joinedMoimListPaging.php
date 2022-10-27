<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>
<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

// $userSeq = '92';
$userSeq = $_POST["userSeq"];
$current_page  = $_POST["page"];
$page_per_item  = $_POST["limit"];

$start_item = ($current_page - 1) * $page_per_item;

$arr = array();

$sql = "SELECT moimSeq FROM member WHERE userSeq = '$userSeq'
        ORDER BY seq ASC limit $start_item, $page_per_item"; //모든 모임 조회
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)){
    // echo "<br>";
    $moimSeq = $row[0];
    // print_r($moimSeq);

    $sql2 = "SELECT * FROM moim WHERE seq = '$moimSeq'";
    $result2 = mysqli_query($conn, $sql2);
    while($row2 = mysqli_fetch_array($result2)){
        
        // 모임에 해당하는 멤버수 확인
        $sql3 = "SELECT COUNT(seq) FROM member WHERE moimSeq = '$moimSeq'"; 
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $joinedCount = $row3[0];

        // 참여중인 모임 개수 확인
        $sql4 = "SELECT COUNT(seq) FROM member WHERE userSeq = '$userSeq'"; 
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_array($result4);
        $itemCount = $row4[0];

        $result_array = array(
            "mainImage" => $row2['mainImage'],
            "address" => $row2['address'],
            "title" => $row2['title'],
            "memberCount" => $row2['memberCount'],
            "moimSeq" => $row2['seq'],
            "interest" => $row2['interest'],
            "joinedCount" => $joinedCount,
            "itemCount" => $itemCount
        );
        $arr[] = $result_array;
    }
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

?>
