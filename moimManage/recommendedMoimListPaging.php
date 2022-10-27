<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$interestAll = $_POST["interestAll"];
$interestCount = $_POST["interestCount"];
$current_page  = $_POST["page"];
$page_per_item  = $_POST["limit"];

// $current_page  = '1';
// $page_per_item  = '10';

$start_item = ($current_page - 1) * $page_per_item;

// $interestAll = '외국/언어;인문학/책;업종/직무';

$arr2 = array();
$arr2 = explode(";", $interestAll);

$arr = array(); // 배열 생성



for($i=0; $i < count($arr2); $i++){
    // print_r($arr[$i]);
    // print_r($i.'<br>');
    // print_r($arr2[$i].'<br>');
    $interest = $arr2[$i];
    // print_r($interest.'<br>');

    $sql = "SELECT * FROM moim WHERE interest LIKE '$interest'
            ORDER BY seq ASC limit $start_item, $page_per_item
            "; //모든 모임 조회
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {


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
}

// 모임 행을 출력하는데,
// 조건은, interest 칼럼의 값이 interestAll에 포함되는지를 확인해야 한다.
// interstAll에는 여러가지 관심분야가 합쳐져 있다.
// interest 칼럼에는 한가지 관심분야만 있다.
// interest 가 interestAll에 포홤되는 경우!


    

// echo json_encode($arr, JSON_UNESCAPED_UNICODE);
echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
