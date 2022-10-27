<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$selectedExpertId = $_POST['selectedExpertId'];



$result = array();
// $result['data'] = array();

$sql = "SELECT userName, reviewGrade, reviewContents, reviewDate FROM review
        JOIN userInfo ON review.id_user = userInfo.seq
        WHERE review.id_expert = '$selectedExpertId'";

$response = mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성
$photoArr = array();

 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "reviewWriterName" => $row['userName'],
         "reviewGrade" => $row['reviewGrade'],
         "reviewContents" => $row['reviewContents'],
         "reviewDate" => $row['reviewDate']
     );
     $arr[] = $result_array;

 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);




mysqli_close($conn);
?>

