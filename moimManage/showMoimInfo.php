<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$moimSeq = $_POST['moimSeq'];



$sql = "SELECT * FROM moim
        WHERE seq = '$moimSeq'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT COUNT(seq) FROM member
        WHERE moimSeq = '$moimSeq'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
$moimCount = $row2[0];


$arr = array(); // 배열 생성


 while ($row = mysqli_fetch_array($result)) {
     $result_array = array(
         "leaderSeq" => $row['leaderSeq'],
         "address" => $row['address'],
         "title" => $row['title'],
         "content" => $row['content'],
         "mainImage" => $row['mainImage'],
         "interest" => $row['interest'],
         "memberCountMax" => $row['memberCount'],
         "memberCount" => $moimCount //멤버정원 x, 현재 참여중인 멤버 수
     );
     $arr = $result_array;
 }



 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
 

 mysqli_close($conn);


?>

