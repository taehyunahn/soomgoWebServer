<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];

// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
$sql = "SELECT * FROM photo WHERE id_userSeq = '$userSeq'";
$result = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "photoPath" => $row['photoPath'],
         "photoId" => $row['photoId']
     );
     $arr[] = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 mysqli_close($conn);


?>

