<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$chatRoomNumber = $_POST['chatRoomNumber'];



// 여러가지 값을 넣어서 응용할 수 있다. -- 끝

$result = array();
// $result['data'] = array();

$sql = "SELECT expertName, serviceRequested, price, expertProfileImage, quote.seq AS quote_seq, expertId  FROM chat_rooms LEFT  
        JOIN request ON chat_rooms.request_Id = request.seq
        JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId
        JOIN quote ON chat_rooms.quote_Id = quote.seq
        WHERE chat_rooms.seq = '$chatRoomNumber'";

$response = mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성
$photoArr = array();

 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "expertName" => $row['expertName'],
         "serviceRequested" => $row['serviceRequested'],
         "price" => $row['price'],
         "expertProfileImage" => $row['expertProfileImage'],
         "quoteId" => $row['quote_seq'],
         "selectedExpertId" => $row['expertId']
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);




mysqli_close($conn);
?>

