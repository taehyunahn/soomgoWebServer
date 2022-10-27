<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$requestId = $_POST['requestId'];
$price = $_POST['price'];

// //expertId를 사용해서, 이름을 찾자. 그리고 Insert할 때, expertName_request에 넣자
// $sql2 = "SELECT * FROM expertInfo WHERE expertId = '$expertId'";
// $result2 = mysqli_query($conn, $sql2);
// $row2 = mysqli_fetch_array($result2);
// $expertName = $row2['expertName'];


$sql = "SELECT * FROM request LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId 
        WHERE request.seq = '$requestId'";
// $sql = "SELECT * FROM request WHERE seq = '$requestId'"; // 전달 받은 값에 해당하는 request 테이블의 행
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$serviceNeed = $row['serviceRequested']; // 요청한 서비스
$userId = $row['userIdWhoRequest']; // 서비스 요청한 사람 ID
$expertId = $row['selectedExpertId']; //요청 받은 고수 ID
$request_Id = $row['seq']; // 요청서 ID


// 클라이언트에서 userSeq만 받으면, 무엇이든지 테이블을 연결해서 값을 찾을 수 있다 -- 응용 가능
// 요청받은 고수 정보를 꺼내는 sql
$sqlForInfo = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
                WHERE expertInfo.expertId LIKE '$expertId'";
$sqlActivate = mysqli_query($conn, $sqlForInfo);
$sqlresultRow = mysqli_fetch_array($sqlActivate);
$expertName = $sqlresultRow['expertName'];
$expertImage = $sqlresultRow['userProfileImage'];

// 여러가지 값을 넣어서 응용할 수 있다. -- 끝


// 클라이언트에서 userSeq만 받으면, 무엇이든지 테이블을 연결해서 값을 찾을 수 있다 -- 응용 가능
// 요청한 고객 정보를 꺼내는 sql
$sqlForInfo2 = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
                WHERE expertInfo.expertId LIKE '$userId'";
$sqlActivate2 = mysqli_query($conn, $sqlForInfo2);
$sqlresultRow2 = mysqli_fetch_array($sqlActivate2);
$clientName = $sqlresultRow2['userName'];
// 여러가지 값을 넣어서 응용할 수 있다. -- 끝


// 견적서를 생성한다.
$sql2 = "INSERT INTO quote (requestId, price) 
          VALUES ('$requestId', '$price')";


if ($conn->query($sql2) ===TRUE) {
    // echo "견적서를 생성했습니다";
    // 채팅방을 개설한다
    $last_id = mysqli_insert_id($conn); // 방금 전에 생성된 견적서의 seq

    $sql3 = "INSERT INTO chat_rooms (quote_Id, request_Id) 
          VALUES ('$last_id', '$requestId')";
          if($conn->query($sql3) ===TRUE){
            // echo "견적서를 생성 + 채팅방 개설 완료";

            $last_id2 = mysqli_insert_id($conn); // 방금 전에 생성된 채팅방의 seq

            $sql4 = "UPDATE quote SET chatRoomId = '$last_id2' WHERE seq = $last_id";
            if($conn->query($sql4) ===TRUE){
              echo $last_id2;
            } else {
              echo "Error: " . $sql."<br>".$conn->error;          
            }

          } else {
            echo "Error: " . $sql."<br>".$conn->error;          
          }

} else {
  echo "Error: " . $sql."<br>".$conn->error;
}


// if ($conn->query($sql) ===TRUE) {
//   // // $last_id = mysqli_insert_id($conn);
//   // // echo $last_id;
//   // // 현재 등록한 고수 고유값(id)를 변수에 담는다.
//   // $last_id = mysqli_insert_id($conn);

//   // // expertInfo 테이블에 고수를 등록하면, userInfo 테이블에도 해당 고수의 id값으로 업데이트하는 쿼리문
//   // // $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
//   // $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
//   // $conn->query($sql2);

//   // $sql3 = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
//   //           SET expertName = '$userName' WHERE seq = $userSeq";
//   // $conn->query($sql3);

//   echo "성공했습니다";


  



// } else {
//   echo "Error: " . $sql."<br>".$conn->error;
// }

$conn -> close();



?>


