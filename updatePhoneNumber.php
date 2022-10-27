<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$newPhoneNumber = $_POST['newPhoneNumber'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo SET userPhoneNumber = '$newPhoneNumber' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo "완료했습니다.";
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
