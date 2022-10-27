<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];
$current_page = $_POST['page'];
$page_per_item = $_POST['limit'];

$searchService = $_POST['service'];
$searchAddress = $_POST['address'];


$result = array();
$result['data'] = array();
// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
$start_item = ($current_page - 1) * $page_per_item;



if($searchAddress == "전국") {
    if($searchService == "모든 서비스") {
        // case1. 전국을 선택했고, 모든 서비스를 선택했을 때
        $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        WHERE exposeOnSearch LIKE '%yes%'
        ORDER BY expertId ASC 
        limit $start_item, $page_per_item
        
        ";

        $sql2 = "SELECT * FROM expertInfo WHERE exposeOnSearch LIKE '%yes%'";
        $countResult = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($countResult);
        
    } 
        // case2. 전국을 선택했고, 특정 서비스를 선택했을 때
    else {

        
        $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        WHERE expertService LIKE '%$searchService%'
        AND exposeOnSearch LIKE '%yes%'
        ORDER BY expertId ASC 
        limit $start_item, $page_per_item

        ";


        $sql2 = "SELECT * FROM expertInfo WHERE expertService LIKE '%$searchService%'
        AND exposeOnSearch LIKE '%yes%'";
        $countResult = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($countResult);


    }

} else {
    // case3. 특정 지역을 선택했고, 모든 서비스를 선택했을 때
    if($searchService == "모든 서비스"){
        $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
        WHERE expertAddress LIKE '%$searchAddress%'
        AND exposeOnSearch LIKE '%yes%'
        ORDER BY expertId ASC 
        limit $start_item, $page_per_item

        ";
        
        $sql2 = "SELECT * FROM expertInfo  WHERE expertAddress LIKE '%$searchAddress%'
        AND exposeOnSearch LIKE '%yes%'";
        $countResult = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($countResult);

    } 
    
    else {
    // case4. 특정 지역을 선택했고, 특정 서비스를 선택했을 때
    $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
    WHERE expertAddress LIKE '%$searchAddress%'
    AND expertService LIKE '%$searchService%'
    AND exposeOnSearch LIKE '%yes%'
    ORDER BY expertId ASC 
    limit $start_item, $page_per_item

    ";

    $sql2 = "SELECT * FROM expertInfo  WHERE expertAddress LIKE '%$searchAddress%'
    AND expertService LIKE '%$searchService%'
    AND exposeOnSearch LIKE '%yes%'";
    $countResult = mysqli_query($conn, $sql2);
    $count = mysqli_num_rows($countResult);

    }

}

// $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
//         ORDER BY expertId ASC 
//         limit $start_item, $page_per_item";
//    // DESC의 반대 - ASC

// // review 테이블의 review 숫자를 구한다
// $sql3 = "SELECT COUNT(reviewId)
//             FROM review
//             WHERE id_expert =  '$expertId'";
// $result3 = mysqli_query($conn, $sql3);
// $row3 = mysqli_fetch_array($result3);
// $reviewCount = $row3['0'];



$response = mysqli_query($conn, $sql);

$arr = array(); // 배열 생성

 while ($row = mysqli_fetch_array($response)) {
     $expertId = $row['expertId'];
    
        // review 테이블의 review 숫자를 구한다
        $sql3 = "SELECT COUNT(reviewId)
                    FROM review
                    WHERE id_expert =  '$expertId'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $reviewCount = $row3['0'];

        // review 테이블의 reviewGrade의 평균을 구한다
        $sql4 = "SELECT AVG(reviewGrade)
        FROM review
        WHERE id_expert =  '$expertId'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_array($result4);
        $reviewAverage = $row4['0'];

        // 고수 ID를 사용해서, 해당 고수와 관련된 quote 테이블에 dealDone된 개수를 합계한다.
        $sql5 = "SELECT COUNT(dealDone)
        FROM quote LEFT JOIN request ON quote.requestId = request.seq
        WHERE dealDone = 'done' AND selectedExpertId = '$expertId'";
        $result5 = mysqli_query($conn, $sql5);
        $row5 = mysqli_fetch_array($result5);
        $hireCount = $row5['0'];

     $result_array = array(
         "expertName" => $row['expertName'],
         "userProfileImage" => $row['userProfileImage'],
         "expertProfileImage" => $row['expertProfileImage'],
         "expertIntro" => $row['expertIntro'],
         "reviewCount" => $reviewCount,
         "reviewAverage" => $reviewAverage,
         "hireCount" => $hireCount,
         "expertId" => $expertId,
         "expertMainService" => $row['expertMainService'],
         "count" => $count


     );
     $arr[] = $result_array;
 }

 echo json_encode($arr, JSON_UNESCAPED_UNICODE);
// echo $searchAddress;
 

 mysqli_close($conn);

 


?>

