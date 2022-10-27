<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$interestAll = $_POST["interestAll"];

$response = array();

$sql = "UPDATE userInfo SET userInterest = '$interestAll'
                        WHERE seq = '$userSeq'";

if ($conn->query($sql) === TRUE) {
    $message = "Successfully userInterest Updated";
    } else {
    $message = "Error: " . $sql."<br>".$conn->error;
    }

// $response["success"] = $success;
$response["message"] = $message;
// $response["successImage"] = $successImage;
// $response["messageImage"] = $messageImage;

// $response["messageImageUpdate"] = $messageImageUpdate;

$response["fileCount"] = $fileCount;
$response["userSeq"] = $userSeq;

echo json_encode($response);

$conn -> close();




?>
