<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST['userSeq'];


$sql = "SELECT * FROM userInfo
        WHERE seq = '$userSeq'";
$result = mysqli_query($conn, $sql);


$arr = array(); // 배열 생성


 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "name" => $row['userName'],
         "profileImage" => $row['userProfileImage'],
         "birthday" => $row['userBirthday'],
         "address" => $row['userAddress'],
         "interestAll" => $row['userInterest'],
         "intro" => $row['userIntro'],
         "gender" => $row['userGender']
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 mysqli_close($conn);


?>

