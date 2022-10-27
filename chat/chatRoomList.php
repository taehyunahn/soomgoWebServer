<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];

// $result = array();
// $result['data'] = array();

// quote 테이블과 expertInfo 테이블을 JOIN 해라

// 현재 로그인한 일반 회원의 ID값을 최로로 전달 받는다.
// 이 회원이 참여하고 있는 방번호를 얻는다
// 이 회원이 참여하고 있는 방에 expertId를 얻는다
// 이 회원이 참여하고 있는 방의 expertId의 상세 정보를 얻는다.
// 그 정보를 리사이클러뷰를 생성하기 위해 사용하니, array로 클라이언트에 보낸다.

$sql = "SELECT * FROM chat_rooms WHERE userId_room = '$userSeq'";
$response = mysqli_query($conn, $sql);

// 얻어야 할 값은?
// 고수프로필 사진, 고수이름, 서비스이름, 견적금액, 마지막메세지, 채팅방번호

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

if(response == true) {
    echo "성공했습니다";
} else {
    echo "Error: " . $sql."<br>".$conn->error;
}



mysqli_close($conn);

?>

