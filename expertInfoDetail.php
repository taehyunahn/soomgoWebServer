<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertId = $_POST['selectedExpertId'];

// 조회하려는 고수 정보를 
$sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        WHERE expertId = '$expertId'";
$result = mysqli_query($conn, $sql);


$sql2 = "SELECT * FROM request
        WHERE selectedExpertId = '$expertId'";
$result2 = mysqli_query($conn, $sql2);
if($result2){
    $row2 = mysqli_fetch_array($result2);
    $requestId = $row2['seq'];        
} else {
    $requestId = "0";        
}

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


// 고수 ID를 사용해서, 해당 고수와 관련된 quote 테이블에 dealDone된 개수를 합계한다.
$sql5 = "SELECT COUNT(dealDone)
            FROM quote LEFT JOIN request ON quote.requestId = request.seq
            WHERE dealDone = 'done' AND selectedExpertId = '$expertId'";
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_array($result5);
$hireCount = $row5['0'];

// print_r($arr);1

$arr = array(); // 배열 생성

 while ($row = mysqli_fetch_array($result)) {

     $result_array = array(
         "expertMainService" => $row['expertMainService'],
         "expertAddress" => $row['expertAddress'],
         "expertTime" => $row['expertTime'],
         "expertYear" => $row['expertYear'],
         "expertIntroDetail" => $row['expertIntroDetail'],
         "expertService" => $row['expertService'],
         "expertProfileImage" => $row['expertProfileImage'],
         "requestId" => $requestId,
         "reviewCount" => $reviewCount,
         "reviewAverage" => $reviewAverage,
         "hireCount" => $hireCount
     );
     $arr = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 
 mysqli_close($conn);

?>

