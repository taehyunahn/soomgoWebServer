<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";



if($_SERVER['REQUEST_METHOD'] == 'POST') {
$userSeq = $_POST['userSeq'];
$userName = $_POST['userName'];


$response['userSeq'] = $userSeq;
$response['userName'] = $userName;


}
 echo json_encode($response, JSON_UNESCAPED_UNICODE);
 
 mysqli_close($conn);


?>

