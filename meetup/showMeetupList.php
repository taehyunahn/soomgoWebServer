<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$moimSeq = $_POST["moimSeq"];

$sql = "SELECT * FROM meetup WHERE moimSeq = '$moimSeq'";
$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : meetupData, meetupTime, address, meetupSeq, moimSeq
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "meetupDate" => $row['meetupDate'],
        "meetupTime" => $row['meetupTime'],
        "address" => $row['address'],
        "meetupSeq" => $row['seq'],
        "moimSeq" => $row['moimSeq'],
        "meetupTitle" => $row['meetupTitle'],
        "fee" => $row['fee'],
        "meetupSeq" => $row['seq']


    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
