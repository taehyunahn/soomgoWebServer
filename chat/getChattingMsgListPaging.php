<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$current_page = $_POST['page'];
$page_per_item = 5;
$start_item = ($current_page - 1) * $page_per_item;

$userSeq = $_POST['userSeq'];
$expertSeq = $_POST['expertSeq'];
$chat_room_seq = $_POST['chat_room_seq'];
$clientOrExpert = $_POST['clientOrExpert'];

$result = array();
$result['data'] = array();


// 1. 고객인 경우
// - C에서 보낸 roomNumber와 S의 roomber가 같은 걸 조회한다.
// - 거기서 고수의 아이디를 찾아서 받아온다.
if($clientOrExpert === "client"){
    $sql = "SELECT * FROM chat_messages WHERE chat_rooms_seq = '$chat_room_seq'
            ORDER BY sentDate ASC
            limit $start_item, $page_per_item

    ";
    $result = mysqli_query($conn, $sql);

    $arr = array(); // 배열 생성

    while ($row = mysqli_fetch_array($result)) {
        $result_array = array(
            "now_time" => $row['sentDate'],
            "message" => $row['messages'],
            "nickname" => '안태현',
            "viewType" => $row['type']

        );
        $arr[] = $result_array;
    }
   
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);

} 

// 2. 고수인 경우
else if ($clientOrExpert === "expert"){
    $sql = "SELECT * FROM chat_messages WHERE chat_rooms_seq = '$chat_room_seq'
            ORDER BY sentDate ASC
            limit $start_item, $page_per_item
            ";
    $result = mysqli_query($conn, $sql);

    $arr = array(); // 배열 생성

    while ($row = mysqli_fetch_array($result)) {
        $result_array = array(
            "now_time" => $row['sentDate'],
            "message" => $row['messages'],
            "nickname" => '안태현',
            "viewType" => $row['type']

        );
        $arr[] = $result_array;
    }
   
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);

?>

