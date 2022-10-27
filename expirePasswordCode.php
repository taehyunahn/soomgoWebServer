<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";


$email = $_POST['email'];

$sql = "INSERT INTO passwordCode (email, code) VALUES ('$email', '1238@!@#a')";
$result = mysqli_query($conn, $sql);

if($result){
    echo "성공했습니다";
} else {
    echo "실패했습니다";
}


$conn -> close();




?>