<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$moimSeq = $_POST['moimSeq'];


$sql = "SELECT * FROM moim
        WHERE seq = '$moimSeq'";
$result = mysqli_query($conn, $sql);


$arr = array(); // 배열 생성


 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "moimTitle" => $row['title']
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 mysqli_close($conn);


?>

