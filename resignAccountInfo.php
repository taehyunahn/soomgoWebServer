<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];

// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
$sql = "UPDATE userInfo SET resign = 'resign'
        WHERE seq = '$userSeq'";
$result = mysqli_query($conn, $sql);
if($result){
        echo "성공했습니다";
} else {
        echo "실패했습니다";
}
        

$conn -> close();

?>

