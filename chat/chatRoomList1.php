<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userSeq = $_POST['userSeq'];

$result = array();
$result['data'] = array();

$sql = "SELECT selectedExpertId, userIdWhoRequest, chat_rooms.seq AS chatRoomId FROM chat_rooms 
        LEFT JOIN request ON chat_rooms.request_Id = request.seq 
        LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId 
        -- LEFT JOIN userInfo ON expert.user_id = userInfo.seq 
        WHERE userIdWhoRequest = '$userSeq'";
$response = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($response)) {
    $index['selectedExpertId'] = $row['selectedExpertId'];
    $index['userIdWhoRequest'] = $row['userIdWhoRequest'];
    $index['chatRoomNumber'] = $row['chatRoomId'];

            array_push($result['data'], $index);    

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>

