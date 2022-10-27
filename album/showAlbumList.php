<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$moimSeq = $_POST["moimSeq"];

// album 테이블에서 moimSeq에 해당되는 행을 선택한다
$sql = "SELECT * FROM album WHERE moimSeq = '$moimSeq'";
$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

// 클라이언트로 보낼 값 : imageUrl, albumSeq, 
while ($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "imageUrl" => $row['imageUrl'],
        "albumSeq" => $row['seq']
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);



?>
