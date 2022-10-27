<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userSeq = $_POST['userSeq'];
$chat_room_seq = $_POST['chat_room_seq'];
$clientOrExpert = $_POST['clientOrExpert'];

//case 1. 고객인 경우, 고수의 고유값(userId)을 얻어와야 한다.
if($clientOrExpert === "client"){
    $sql = "SELECT * FROM chat_rooms 
            LEFT JOIN request ON chat_rooms.request_Id = request.seq
            LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId
            WHERE chat_rooms.seq = '$chat_room_seq'";
    $response = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($response);
    echo $row['user_id'];
} 
    //case 2. 고수인 경우, 고객의 고유값(userId)을 얻어와야 한다
    else if($clientOrExpert === "expert") {
        $sql = "SELECT * FROM chat_rooms 
        LEFT JOIN request ON chat_rooms.request_Id = request.seq
        LEFT JOIN userInfo ON request.userIdWhoRequest = userInfo.seq
        WHERE chat_rooms.seq = '$chat_room_seq'";
        $response = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($response);
        echo $row['userIdWhoRequest'];
    }

mysqli_close($conn);

?>

