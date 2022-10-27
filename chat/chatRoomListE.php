<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userSeq = $_POST['userSeq'];

$result = array();
$result['data'] = array();

// quote 테이블과 expertInfo 테이블을 JOIN 해라

// 현재 로그인한 일반 회원의 ID값을 최로로 전달 받는다.
// 이 회원이 참여하고 있는 방번호를 얻는다
// 이 회원이 참여하고 있는 방에 expertId를 얻는다
// 이 회원이 참여하고 있는 방의 expertId의 상세 정보를 얻는다.
// 그 정보를 리사이클러뷰를 생성하기 위해 사용하니, array로 클라이언트에 보낸다.



// $sql = "SELECT selectedExpertId, userIdWhoRequest, chat_rooms.seq AS chatRoomId, chat_messages.sentDate AS recentMessageDate  FROM chat_rooms 
//         LEFT JOIN request ON chat_rooms.request_Id = request.seq 
//         LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId 
//         LEFT JOIN chat_messages ON chat_rooms.seq = chat_messages.chat_rooms_seq
//         WHERE selectedExpertId = '$userSeq'
//         order by recentMessageDate desc
//         ";


$sql = "SELECT selectedExpertId, userIdWhoRequest, chat_rooms.seq AS chatRoomId FROM chat_rooms 
        LEFT JOIN request ON chat_rooms.request_Id = request.seq 
        LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId 
        
        -- LEFT JOIN userInfo ON expert.user_id = userInfo.seq 
        WHERE selectedExpertId = '$userSeq'";
$response = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($response)) {
    $index['selectedExpertId'] = $row['selectedExpertId'];
    $index['userIdWhoRequest'] = $row['userIdWhoRequest'];
    $index['chatRoomNumber'] = $row['chatRoomId'];

            array_push($result['data'], $index);    

}

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

// if(response == true) {
//     while($row = mysqli_fetch_array($response)) {
//         $index['expertName'] = $row['expertName_ro'];
//         $index['chatRoomNumber'] = $row['seq'];

//         array_push($result['data'], $index);    
//     }
    
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
// } else {
//     echo "Error: " . $sql."<br>".$conn->error;

// }

// if(response == true) {
//     echo "성공했습니다";
// } else {
//     echo "Error: " . $sql."<br>".$conn->error;
// }



mysqli_close($conn);

?>

