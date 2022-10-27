<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$imageCount = $_POST['imageCount'];
$userSeq = $_POST['userSeq'];

if(isset($_FILES['uploaded_file0']['tmp_name'])){

  for($i = 0; $i<$imageCount; $i++){
    $srcName = $_FILES['uploaded_file'.$i]['name'];
    $tmpName = $_FILES['uploaded_file'.$i]['tmp_name'];

    $file_path = '/var/www/html/images/' . date('Ymd_his') . $srcName . '.jpeg';


    //클라이언트에서 보낸 파일의 숫자만큼 이미지 파일이 생성된다.
    //userInfo 테이블과 연결하는 photo 테이블을 만들자
    //userInfo 테이블에 photo_id 칼럼을 만든다
    //photo_id 칼럼

    if(move_uploaded_file($_FILES['uploaded_file'.$i]['tmp_name'], $file_path)){
      // $sql = "SELECT * FROM userInfo LEFT JOIN photo ON userInfo.photo_id = photo.photoId 
      //         WHERE seq = '$userSeq'";

      $path = 'http://3.38.178.28/images/' . date('Ymd_his') . $srcName . '.jpeg';
      $query = "INSERT INTO photo (photoPath, id_userSeq) VALUES ('$path','$userSeq')"; 
      // 이미지주소 + 회원고유번호를 DB에 저장한다
      mysqli_query($conn,$query);
      // if(mysqli_query($conn,$query)){
      //   $last_id = mysqli_insert_id($conn);

      //   $query = "UPDATE userInfo SET photo_id = '$last_id' WHERE seq = '$userSeq'";
      //   mysqli_query($conn,$query);
      // }
  
      }

    }
  }


    // $sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
    //     WHERE seq = '$userSeq'";
// $sql = "UPDATE userInfo SET userProfileImage = '$imagestore' WHERE seq = $userSeq";

// $sql2 = "SELECT * FROM userInfo WHERE seq = '$userSeq'";
// $result2 = mysqli_query($conn, $sql2);
// $row = mysqli_fetch_array($result2);

// // if (userProfileImage)

// if ($conn->query($sql) ===TRUE) {
//   echo $row['userProfileImage'];
// } else {
//   echo "Error: " . $sql."<br>".$conn->error;
// }

// $conn -> close();

?>