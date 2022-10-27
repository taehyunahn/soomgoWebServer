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


// 여러가지 값을 넣어서 응용할 수 있다. -- 끝

$result = array();
// $result['data'] = array();

$sql = "SELECT * FROM request LEFT JOIN userInfo ON request.userIdWhoRequest = userInfo.seq
        WHERE userIdWhoRequest = '$userIdWhoRequest'";

// $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
// WHERE exposeOnSearch LIKE '%yes%'";

// $response = mysqli_query($conn, $sql);


$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성
$photoArr = array();


 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "userIdWhoRequest" => $row['userIdWhoRequest'],
         "clientName" => $row['userName'],
         "addressInfo" => $row['addressInfo'],
         "serviceRequested" => $row['serviceRequested'],
         "requestDate" => $row['date'],
         "lastDate" => $lastDate,
         "lastMsg" => $lastMsg
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);




mysqli_close($conn);
?>

