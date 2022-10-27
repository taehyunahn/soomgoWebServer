<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];



$sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        WHERE seq = '$userSeq'";
$result = mysqli_query($conn, $sql);


$sql10 = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        WHERE seq = '$userSeq'";
$result10 = mysqli_query($conn, $sql10);
$row10 = mysqli_fetch_array($result10);
$expertId = $row10['expertId'];



// review 테이블의 review 숫자를 구한다
$sql3 = "SELECT COUNT(reviewId)
            FROM review
            WHERE id_expert =  '$expertId'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);
$reviewCount = $row3['0'];


// review 테이블의 reviewGrade의 평균을 구한다
$sql4 = "SELECT AVG(reviewGrade)
            FROM review
            WHERE id_expert =  '$expertId'";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_array($result4);
$reviewAverage = $row4['0'];



// $sql2 = "SELECT seq, sentDate, messages
//         FROM chat_messages WHERE chat_rooms_seq = $chatRoomNumber order by sentDate desc limit 1
//         ";

// $result2 = mysqli_query($conn, $sql2);

// while($row2 = mysqli_fetch_array($result2)){
// $lastMsg = $row2['messages'];
// $lastDate = $row2['sentDate'];
// }

// 




// print_r($arr);1

$arr = array(); // 배열 생성
$photoArr = array();


 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "expertName" => $row['expertName'],
         "userProfileImage" => $row['userProfileImage'],
         "expertProfileImage" => $row['expertProfileImage'],
         "expertIntro" => $row['expertIntro'],
         "expertAddress" => $row['expertAddress'],
         "expertYear" => $row['expertYear'],
         "expertService" => $row['expertService'],
         "expertMainService" => $row['expertMainService'],
         "expertIntroDetail" => $row['expertIntroDetail'],
         "userName" => $row['userName'],
         "userEmail" => $row['userEmail'],
         "expertTime" => $row['expertTime'],
         "reviewCount" => $reviewCount,
         "reviewAverage" => $reviewAverage
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 mysqli_close($conn);


?>

