<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertName = $_POST['expertName'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        SET expertName = '$expertName' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo $expertName;
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
