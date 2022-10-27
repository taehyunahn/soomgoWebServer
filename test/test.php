<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];
// $userName = $_POST['userName'];
// $userProfileImage = $_POST['userProfileImage'];

// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
$sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        WHERE seq = '$userSeq'";
$result = mysqli_query($conn, $sql);

// print_r($arr);1

$arr = array(); // 배열 생성

 while ($row = mysqli_fetch_array($result)) {

     $result_array = array(
        // "userSeq" => $row['seq'], 
        // "userName" => $row['userName'],
        //  "userProfileImage" => $row['userProfileImage']

        "userSeq" => $userSeq, 
        "userName" => $userName,
        "userProfileImage" => $userProfileImage
         
     );
     $arr = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 $conn -> close();

?>
