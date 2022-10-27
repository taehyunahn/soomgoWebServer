<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userIdWhoRequest = $_POST['userIdWhoRequest'];
$reviewGrade = $_POST['reviewGrade'];
$reviewContents = $_POST['reviewContents'];
$selectedExpertId = $_POST['selectedExpertId'];


//할 일 1. review 테이블에 insert(리뷰쓴고객 userSeq, 내용, 평점)한다. 
//할 일 2. 그리고 insert된 행의 id값으로 expertInfo의 reviewId칼럼을 update한다.


$result = array();
// $result['data'] = array();

// $sql2 = "UPDATE quote SET dealPrice = '$dealPrice', dealDone = 'done', dealDate = '$dealDate' 
//         WHERE seq = '$quoteId'";
// $response2 = mysqli_query($conn, $sql2);


$sql2 = "INSERT INTO review (reviewContents, reviewGrade, id_user, id_expert)
         VALUES ('$reviewContents', '$reviewGrade', '$userIdWhoRequest', '$selectedExpertId' )";
$response2 = mysqli_query($conn, $sql2);
$last_id = mysqli_insert_id($conn);


$sql = "UPDATE expertInfo SET review_id = '$last_id'
        WHERE expertId = '$selectedExpertId'";
$result = mysqli_query($conn, $sql);







// 아래와 같이 클라이언트에 보낼 필요는 없는데, 아무것도 안보내면 에러가 떠서 일단 작성함
$sql10 = "SELECT * FROM expertInfo
        WHERE expertId = '$selectedExpertId'";
$result10 = mysqli_query($conn, $sql10);
$arr = array(); // 배열 생성
$photoArr = array();

 while ($row = mysqli_fetch_array($result10)) {
     $result_array = array(
         "expertId" => $row['expertId']
     );
     $arr = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);



mysqli_close($conn);
?>

