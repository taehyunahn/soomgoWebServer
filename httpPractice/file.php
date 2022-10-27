<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

$file = $_FILES['aaa'];
// 대입된 $file은 파일의 여러정보를 가지기 위해 배열로 된 변수임

$srcName = $file['name'];
$fileTypr = $file['type'];
$fileSize = $file['size'];
$tmpName = $file['tmp_name'];

echo "$srcName <br>";
echo "$fileTypr <br>";
echo "$fileSize <br>";
echo "$tmpName <br>";
echo $_SERVER['DOCUMENT_ROOT'].'/category3_review/'. date('Ymd_his'). $srcName;

$dstNme = $_SERVER['DOCUMENT_ROOT']."/category3_review/". date('Ymd_his'). $srcName;

echo "<br>";

//move_uploaded_file — Moves an uploaded file to a new location
//기본 형태 = move_uploaded_file(string $from, string $to): bool
//This function checks to ensure that the file designated by from is a valid upload file (meaning that it was uploaded via PHP's HTTP POST upload mechanism). 
//If the file is valid, it will be moved to the filename given by to.
//This sort of check is especially important if there is any chance that anything done with uploaded files could reveal their contents to the user, 
//or even to other users on the same system.
//from = The filename of the uploaded file.
//to = The destination of the moved file.

if(move_uploaded_file($tmpName, $dstNme)){
    echo "move_uploaded_file 성공";
} else {
    echo "move_uploaded_file 실패";
};


?>