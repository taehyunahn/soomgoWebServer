<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$userSeq = $_POST['userSeq'];
$roomNumber = $_POST['roomNumber'];

$sql = "SELECT COUNT(unreadSeq) FROM unread WHERE room_Id  = '$roomNumber' AND receiver_Id = '$userSeq'";
$response = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($response);


if($response){
        echo $row['0'];

}else {
        echo "0";
}
// $row = mysqli_fetch_array($response);
// echo $row['userProfileImage'];

mysqli_close($conn);

?>

