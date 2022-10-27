<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userIdWhoRequest = $_POST['userIdWhoRequest'];
$selectedExpertId = $_POST['selectedExpertId'];
$chatRoomNumber = $_POST['chatRoomNumber'];

$sql2 = "SELECT seq, sentDate, messages
        FROM chat_messages WHERE chat_rooms_seq = $chatRoomNumber order by sentDate desc limit 1
        ";

$result2 = mysqli_query($conn, $sql2);

while($row2 = mysqli_fetch_array($result2)){
$lastMsg = $row2['messages'];
$lastDate = $row2['sentDate'];
}

$result = array();
// $result['data'] = array();

//채팅 상대 expert 정보가 필요하다
$sql = "SELECT expertProfileImage, userName, expertName, serviceRequested, expertAddress, price, request.date AS date_request
        FROM request 
        LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId
        LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        LEFT JOIN quote ON request.seq = quote.requestId
        WHERE selectedExpertId = '$selectedExpertId'";

$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성
$photoArr = array();

 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
        "expertImage" => $row['expertProfileImage'],
        "expertName" => $row['expertName'],
        "serviceRequested" => $row['serviceRequested'],
         "expertAddress" => $row['expertAddress'],
         "price" => $row['price'],
         "lastDate" => $lastDate,
         "lastMsg" => $lastMsg
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);




mysqli_close($conn);
?>

