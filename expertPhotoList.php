<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertSeq = $_POST['expertSeq'];

$result = array();
$result['data'] = array();


$sql = "SELECT * FROM expertInfo LEFT JOIN photo ON expertInfo.expertId = photo.id_expert
        WHERE id_expert = '$expertSeq'
        ";

// if($searchAddress == "전국") {
//     if($searchService == "모든 서비스") {
//         // case1. 전국을 선택했고, 모든 서비스를 선택했을 때
        
//     } 
//         // case2. 전국을 선택했고, 특정 서비스를 선택했을 때
//     else {
//         $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
//         WHERE expertService LIKE '%$searchService%'
//         ";
//     }

// } else {
//     // case3. 특정 지역을 선택했고, 모든 서비스를 선택했을 때
//     if($searchService == "모든 서비스"){
//         $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
//         WHERE expertAddress LIKE '%$searchAddress%'
//         ";
//     } 
    
//     else {
//     // case4. 특정 지역을 선택했고, 특정 서비스를 선택했을 때
//     $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
//     WHERE expertAddress LIKE '%$searchAddress%'
//     AND expertService LIKE '%$searchService%'
//     ";
//     }

// }



// SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
$response = mysqli_query($conn, $sql);


while($row = mysqli_fetch_array($response)) {
    $index['photoId'] = $row['photoId'];
    $index['photoAddress'] = $row['photoAddress'];
    $index['id_expert'] = $row['id_expert'];

    array_push($result['data'], $index);

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
 


?>

