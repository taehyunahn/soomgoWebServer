<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";


$interest = $_POST['interest'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo SET userInterest = '$interest' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo "성공했습니다";
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
