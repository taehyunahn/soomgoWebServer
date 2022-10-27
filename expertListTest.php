<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";


$userSeq = $_POST['userSeq'];
$current_page = $_POST['page'];
$page_per_item = $_POST['limit'];


$result = array();
$result['data'] = array();
// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다


$start_item = ($current_page - 1) * $page_per_item;


$sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        ORDER BY expertId ASC 
        limit $start_item, $page_per_item";
   // DESC의 반대 - ASC

// SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId


$response = mysqli_query($conn, $sql);
// if($response) {
//     echo "동작합니다";
// } else {
//     echo "Error: " . $sql."<br>".$conn->error;
// }


// $total_item = mysqli_num_rows($response); //전체 아이템수 (from DB)
// $end_page = ceil($total_item / $page_per_item);



// while($row = mysqli_fetch_array($response)) {
//     $index['expertName'] = $row['expertName'];
//     $index['userProfileImage'] = $row['userProfileImage'];
//     $index['expertIntro'] = $row['expertIntro'];
//     $index['reviewCount'] = $row['review_count'];
//     $index['reviewAverage'] = $row['review_average'];
//     $index['hireCount'] = $row['hire_count'];
//     $index['expertId'] = $row['expertId'];
//     $index['expertMainService'] = $row['expertMainService'];


//     array_push($result['data'], $index);

// }

// echo json_encode($result, JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);

$arr = array(); // 배열 생성

 while ($row = mysqli_fetch_array($response)) {
     $result_array = array(
         "expertName" => $row['expertName'],
         "userProfileImage" => $row['userProfileImage'],
         "expertIntro" => $row['expertIntro'],
         "reviewCount" => $row['review_count'],
         "reviewAverage" => $row['review_average'],
         "hireCount" => $row['hire_count'],
         "expertId" => $row['expertId'],
         "expertMainService" => $row['expertMainService']


     );
     $arr[] = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 mysqli_close($conn);

 


?>

