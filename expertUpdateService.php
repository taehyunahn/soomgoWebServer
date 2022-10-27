<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";


$updatedService = $_POST['updatedService'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE expertInfo LEFT JOIN userInfo ON userInfo.expert_id = expertInfo.expertId
        SET expertService = '$updatedService' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo $updatedService;

} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


// $userSeq = $_POST['userSeq'];

// // 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
// $sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
//         WHERE seq = '$userSeq'";
// $result = mysqli_query($conn, $sql);

// // print_r($arr);1

// $arr = array(); // 배열 생성

//  while ($row = mysqli_fetch_array($result)) {

//      $result_array = array(
//          "expertName" => $row['expertName'],
//          "expertMainService" => $row['expertMainService'],
//          "userProfileImage" => $row['userProfileImage'],
//          "expertIntro" => $row['expertIntro'],
//          "expertAddress" => $row['expertAddress'],
//          "expertYear" => $row['expertYear'],
//          "expertService" => $row['expertService'],
//          "expertIntroDetail" => $row['expertIntroDetail'],
//          "userName" => $row['userName'],
//          "userEmail" => $row['userEmail'],
//      );
//      $arr = $result_array;
//  }

//  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 


?>

