<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertIntro = $_POST['expertIntro'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        SET expertIntro = '$expertIntro' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo $expertIntro;
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
