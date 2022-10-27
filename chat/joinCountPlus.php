<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$roomNumber = $_POST['roomNumber'];

//case 1. 고객인 경우, 고수의 고유값(userId)을 얻어와야 한다.

$sql = "SELECT * FROM chat_rooms WHERE seq = '$roomNumber'";
$response = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($response);
$updatedCount = $row['joinCount'] + 1;

if($response){
        $sql2 = "UPDATE chat_rooms SET joinCount = '$updatedCount'  WHERE seq = '$roomNumber'";
        $response2 = mysqli_query($conn, $sql2);
        if($response2){
                echo $updatedCount;
        } else {
                echo "0";
        }
}else {
        echo "0";
}
// $row = mysqli_fetch_array($response);
// echo $row['userProfileImage'];

mysqli_close($conn);

?>

