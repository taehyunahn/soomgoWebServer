<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$numberOfAccount = $_POST['numberOfAccount'];


  $userPassword_hash = hash("sha256", $numberOfAccount);

  $sql = "INSERT INTO userInfo (userEmail, userPassword, userName, userOption) 
          VALUES ('$numberOfAccount', '$userPassword_hash', '$numberOfAccount', '고객')";
  $conn->query($sql);
  $last_id = mysqli_insert_id($conn); //고객의 고유 번호 생성된 값


  $sql2 = "INSERT INTO expertInfo (expertService, 
                            expertAddress, 
                            expertGender, 
                            expertPhoneNumber, 
                            user_id,
                            expertName,
                            expertMainService,
                            expertIntro,
                            expertTime,
                            expertYear,
                            expertIntroDetail,
                            exposeOnSearch
                        
                            ) 
        VALUES 
        ('화상영어/전화영어 회화-TOEIC/speaking/writing 과외', 
         '서울 강남구', 
         '남자', 
         '010-0000-0000', 
         '$last_id',
         '테스트계정$numberOfAccount',
         '전화영어 회화-TOEIC/speaking/writing과외',
         '안녕하세요.반갑습니다.',
         '08시-22시',
         '7년',
         '저의 경력은 이렇습니다. 참고하세요',
         'yes'
         )";

         //영어 과외-비즈니스 영어-화상영어/전화영어 회화-TOEIC/speaking/writing과외
  $conn->query($sql2);
  $last_id2 = mysqli_insert_id($conn); //고객의 고유 번호 생성된 값

  $sql3 = "UPDATE userInfo SET expert_id = '$last_id2' WHERE seq = $last_id";
  $conn->query($sql3);


$conn -> close();


?>


<?php

// $sql = "INSERT INTO expertInfo (expertService, 
//                             expertAddress, expertGender, expertPhoneNumber, user_id) 
//         VALUES 
//         ('$expertService', 
//          '$expertAddress', '$expertGender', '$expertPhoneNumber', '$userSeq')";



// if ($conn->query($sql) ===TRUE) {
//   // $last_id = mysqli_insert_id($conn);
//   // echo $last_id;
//   // 현재 등록한 고수 고유값(id)를 변수에 담는다.
//   $last_id = mysqli_insert_id($conn);

//   // expertInfo 테이블에 고수를 등록하면, userInfo 테이블에도 해당 고수의 id값으로 업데이트하는 쿼리문
//   // $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
//   $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
//   $conn->query($sql2);

//   $sql3 = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
//             SET expertName = '$userName' WHERE seq = $userSeq";
//   $conn->query($sql3);

//   echo "성공했습니다";



?>