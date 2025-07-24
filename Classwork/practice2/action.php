<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_server = 'localhost';
$db_username = 'root';
$db_name = 'test_db';
$db_password = 'Linmeng@2003';

try {
    $connect = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'connection successfuly';
} catch (PDOException $e) {
    echo 'connection failed' . $e->getMessage();
}
?>
