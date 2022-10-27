<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$addressResult = $_POST['addressResult'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
        SET expertAddress = '$addressResult' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo $userName;
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
