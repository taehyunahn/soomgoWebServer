<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertId = $_POST['expertId'];



$sql = "SELECT age, how, day, schedule, gender, addressInfo, question, request.seq AS request_seq, quote.seq AS quote_seq, chatroomId, userIdWhoRequest
        FROM request LEFT JOIN quote ON request.seq = quote.requestId
        WHERE selectedExpertId = '$expertId'";

// $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
// WHERE exposeOnSearch LIKE '%yes%'";

$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

 while ($row = mysqli_fetch_array($result)) {

     $result_array = array(
         "age" => $row['age'],
         "how" => $row['how'],
         "day" => $row['day'],
         "schedule" => $row['schedule'],
         "gender" => $row['gender'],
         "addressInfo" => $row['addressInfo'],
         "question" => $row['question'],
         "requestId" => $row['request_seq'], // request 테이블의 행 고유값
         "quoteId" => $row['quote_seq'], // quote 테이블의 행 고유값
         "question" => $row['question'],
         "chatroomId" => $row['chatroomId'],
         "userIdWhoRequest" => $row['userIdWhoRequest'],

     );
     $arr = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 
 mysqli_close($conn);


// while($row = mysqli_fetch_array($response)) {
//     $index['addressInfo'] = $row['addressInfo'];
//     $index['expertId'] = $row['expertId'];
//     $index['userId'] = $row['userId'];
//     $index['serviceNeed'] = $row['serviceNeed'];
//     $index['requestDate'] = $row['date'];

//     array_push($result['data'], $index);

// }

// echo json_encode($result, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);

?>

