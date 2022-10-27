<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$page_per_item = 500;
$start_item = 0;

$userSeq = $_POST['userSeq'];
$chat_room_seq = $_POST['chat_room_seq'];
$clientOrExpert = $_POST['clientOrExpert'];

$result = array();
$result['data'] = array();

// - C에서 보낸 roomNumber와 S의 roomber가 같은 걸 조회한다.
// - 거기서 고수의 아이디를 찾아서 받아온다.
    $sql = "SELECT * FROM chat_messages 
            LEFT JOIN userInfo ON chat_messages.userIdWhoSent = userInfo.seq
            LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
            LEFT JOIN unread ON chat_messages.seq = unread.message_Id
            WHERE chat_rooms_seq = '$chat_room_seq'
            ORDER BY sentDate ASC
            limit $start_item, $page_per_item
            ";
    $result = mysqli_query($conn, $sql);

    $arr = array(); // 배열 생성

    if($clientOrExpert == "expert") {
        while ($row = mysqli_fetch_array($result)) {
            $result_array = array(
                "now_time" => $row['sentDate'],
                "message" => $row['messages'],
                "nicknameUser" => $row['userName'],
                "nicknameExpert" => $row['expertName'],
                "userProfileImage" => $row['userProfileImage'],
                "viewType" => $row['type'],
                "userIdWhoSent" => $row['userIdWhoSent'],
                "chat_room_seq" => $row['seq'],
                "unread" => $row['unreadSeq']
    
                
            );
            $arr[] = $result_array;
        }
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $result_array = array(
                "now_time" => $row['sentDate'],
                "message" => $row['messages'],
                "nicknameUser" => $row['expertName'],
                "nicknameExpert" => $row['expertName'],
                "userProfileImage" => $row['expertProfileImage'],
                "viewType" => $row['type'],
                "userIdWhoSent" => $row['userIdWhoSent'],
                "chat_room_seq" => $row['seq'],
                "unread" => $row['unreadSeq']
    
                
            );
            $arr[] = $result_array;
        }
    }

   
    
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);



mysqli_close($conn);

?>


