<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
    //php 에러 확인을 위한 코드 : 에러에 대한 설명을 화면에 표시한다.
?>

<?php

$files = $_FILES['aaa'];
// 대입된 $file은 파일의 여러정보를 가지기 위해 배열로 된 변수임

// $num = count($files);
// $num2 = count($files['name']);

$fileNum = count($files['name']);
//전달 받은 파일 숫자

for($i=0; $i<$fileNum; $i++){
    $srcName = $files['name'][$i]; //파일 이름
    $tmpName = $files['tmp_name'][$i]; //파일 임시이름
    $fileTypr = $files['type'][$i]; //파일 타입
    $fileSize = $files['size'][$i]; //파일 사이즈

    echo "파일 이름 : $srcName <br>";
    echo "파일 임시이름 : $tmpName <br>";
    echo "파일 타입 : $fileTypr <br>";
    echo "파일 사이즈 : $fileSize <br>";
    
    // $filePath = $_SERVER['DOCUMENT_ROOT']."/category3_review/images/". date('Ymd_his'). $srcName;
    // $filePath = "/var/www/html/category3_review/images/". date('Ymd_his'). $srcName;
    $filePath = "./images/". date('Ymd_his'). $srcName;
    // 전달받은 파일을 옮길 경로 -> 현재폴더에서 images 폴더 + 현재날짜 + 파일이름

    if(move_uploaded_file($tmpName, $filePath)){
        //업로드된 파일($tmpName)을 새로 지정한 위치($filePath)로 옮겨라

        //move_uploaded_file — Moves an uploaded file to a new location
        //기본 형태 = move_uploaded_file(string $from, string $to)
        //(parameter 1) from = The filename of the uploaded file.
        //(parameter 2) to = The destination of the moved file.

        echo "move_uploaded_file 성공".$i."<br><br>"; //파일이 이동됐는지 확인
    };
}

echo "<br><br> 총 $fileNum 개의 파일을 수신하여, 저장했습니다."



//move_uploaded_file — Moves an uploaded file to a new location
//기본 형태 = move_uploaded_file(string $from, string $to): bool
//This function checks to ensure that the file designated by from is a valid upload file (meaning that it was uploaded via PHP's HTTP POST upload mechanism). 
//If the file is valid, it will be moved to the filename given by to.
//This sort of check is especially important if there is any chance that anything done with uploaded files could reveal their contents to the user, 
//or even to other users on the same system.
//from = The filename of the uploaded file.
//to = The destination of the moved file.



?>