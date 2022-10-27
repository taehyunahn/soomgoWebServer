<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertSeq = $_POST["expertSeq"];
$isChecked = $_POST["isChecked"];

$response = array();

$sql = "UPDATE expertInfo SET exposeOnSearch = '$isChecked' WHERE expertId = '$expertSeq'";
mysqli_query($conn, $sql);    

$response["expertSeq"] = $expertSeq;
$response["isChecked"] = $isChecked;

echo json_encode($response);

?>
