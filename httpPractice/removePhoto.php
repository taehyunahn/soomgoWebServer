<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$photoPath = $_POST["photoPath"];


// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
$query = "DELETE * FROM photo WHERE photoPath = '$photoPath'";
$result = mysqli_query($conn, $query);

if($result) {
    echo "삭제했습니다";
} else {
    echo "삭제되지 않았습니다";
}



mysqli_close($conn);

?>
