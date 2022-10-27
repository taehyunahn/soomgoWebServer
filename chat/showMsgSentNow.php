<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userSeq = $_POST['userSeq'];
$roomNumber = $_POST['roomNumber'];


//case 1. 고객인 경우, 고수의 고유값(userId)을 얻어와야 한다.

$sql = "DELETE FROM unread WHERE receiver_Id = '$userSeq' AND room_Id = '$roomNumber' ";
$response = mysqli_query($conn, $sql);

if($response){
        echo "1";

}else {
        echo "0";
}
// $row = mysqli_fetch_array($response);
// echo $row['userProfileImage'];

mysqli_close($conn);

?>

