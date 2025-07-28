<?php
$db_server = 'localhost';
$db_username = 'root';
$db_name = 'upload_image';
$db_password = 'Linmeng@2003';

try {
    $connect = new PDO("mysql:host = $db_server; dbname = $db_name", $db_username, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'connect sunccess';
} catch (PDOException $e) {
    echo "failed connect" . $e->getMessage();
}
