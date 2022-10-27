<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userSeq = $_POST['userSeq'];
$clientOrExpert = $_POST['clientOrExpert'];
//case 1. 고객인 경우, 고수의 고유값(userId)을 얻어와야 한다.

if($clientOrExpert == "client") {
        $sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.seq = expertInfo.user_id 
        WHERE seq = '$userSeq'";
        $response = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($response);
        echo $row['userProfileImage'];
} else {
        $sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.seq = expertInfo.user_id 
        WHERE seq = '$userSeq'";
        $response = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($response);
        echo $row['expertProfileImage'];
}


mysqli_close($conn);

?>

