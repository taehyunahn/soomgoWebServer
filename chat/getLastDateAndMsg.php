<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$chatRoomNumber = $_POST['chatRoomNumber'];


$result = array();
// $result['data'] = array();

//채팅 상대 expert 정보가 필요하다
$sql = "SELECT seq, sentDate, messages
        FROM chat_messages order by sentDate desc limit 1
        WHERE seq = '$chatRoomNumber'";

$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성
$photoArr = array();

 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
        "lastMsg" => $row['messages'],
        "lastDate" => $row['sentDate']
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);




mysqli_close($conn);
?>

