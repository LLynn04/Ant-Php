<?php
$file = $_FILES['file'];
// print_r($file);

if ($_SERVER['REQUEST_METHOD' ] === 'POST'){
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0){
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        echo $fileType;
    }
}