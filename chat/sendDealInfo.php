<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$quoteId = $_POST['quoteId'];
$dealPrice = $_POST['dealPrice'];
$dealDate = $_POST['dealDate'];

// 여러가지 값을 넣어서 응용할 수 있다. -- 끝

$result = array();
// $result['data'] = array();

$sql2 = "UPDATE quote SET dealPrice = '$dealPrice', dealDone = 'done', dealDate = '$dealDate' 
        WHERE seq = '$quoteId'";
$response2 = mysqli_query($conn, $sql2);


$sql = "SELECT * FROM quote
        WHERE seq = '$quoteId'";
$result = mysqli_query($conn, $sql);
$arr = array(); // 배열 생성
$photoArr = array();

 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "chatRoomNumber" => $row['chatRoomId']
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);




mysqli_close($conn);
?>

