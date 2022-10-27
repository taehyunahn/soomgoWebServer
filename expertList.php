<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$searchService = $_POST['searchService'];
$searchAddress = $_POST['searchAddress'];
$userSeq = $_POST['userSeq'];
$sort = $_POST['sort'];

$result = array();
$result['data'] = array();
// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다


if($searchAddress == "전국") {
    if($searchService == "모든 서비스") {
        // case1. 전국을 선택했고, 모든 서비스를 선택했을 때
        $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        WHERE exposeOnSearch LIKE '%yes%'
        
        ";
    } 
        // case2. 전국을 선택했고, 특정 서비스를 선택했을 때
    else {
        $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        WHERE expertService LIKE '%$searchService%'
        AND exposeOnSearch LIKE '%yes%'

        ";
    }

} else {
    // case3. 특정 지역을 선택했고, 모든 서비스를 선택했을 때
    if($searchService == "모든 서비스"){
        $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        WHERE expertAddress LIKE '%$searchAddress%'
        AND exposeOnSearch LIKE '%yes%'

        ";
    } 
    
    else {
    // case4. 특정 지역을 선택했고, 특정 서비스를 선택했을 때
    $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
    WHERE expertAddress LIKE '%$searchAddress%'
    AND expertService LIKE '%$searchService%'
    AND exposeOnSearch LIKE '%yes%'

    ";
    }

}



// SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
$response = mysqli_query($conn, $sql);


while($row = mysqli_fetch_array($response)) {
    $index['expertName'] = $row['expertName'];
    $index['userProfileImage'] = $row['userProfileImage'];
    $index['expertProfileImage'] = $row['expertProfileImage'];
    $index['expertIntro'] = $row['expertIntro'];
    $index['reviewCount'] = $row['review_count'];
    $index['reviewAverage'] = $row['review_average'];
    $index['hireCount'] = $row['hire_count'];
    $index['expertId'] = $row['expertId'];
    $index['expertMainService'] = $row['expertMainService'];


    array_push($result['data'], $index);

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
 


?>

