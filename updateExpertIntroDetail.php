<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertIntroDetail = $_POST['expertIntroDetail'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        SET expertIntroDetail = '$expertIntroDetail' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
