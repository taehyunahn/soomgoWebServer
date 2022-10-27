<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php
$fileCount = $_POST["fileCount"];

for($i=0; $i<$fileCount; $i++){
    $files = $_FILES['imageName'.$i];
    $srcName = $files['name']; //파일 이름
    $tmpName = $files['tmp_name']; //파일 임시이름
    $fileTypr = $files['type']; //파일 타입
    $fileSize = $files['size']; //파일 사이즈

    // echo "파일 이름 : $srcName <br>";
    // echo "파일 임시이름 : $tmpName <br>";
    // echo "파일 타입 : $fileTypr <br>";
    // echo "파일 사이즈 : $fileSize <br>";

    $filePath = "./images/". date('Ymd_his'). $srcName;

    if(move_uploaded_file($tmpName, $filePath)){


    echo "move_uploaded_file 성공"."<br><br>"; //파일이 이동됐는지 확인
    } else {

    };
}

?>
