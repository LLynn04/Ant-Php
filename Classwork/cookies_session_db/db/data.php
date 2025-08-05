<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_server = 'localhost';
$db_username = 'root';
$db_name = 'cookiesSession';
$db_password = 'Linmeng@2003';

try {
    $connect = new PDO("mysql:host=$db_server;dbname=$db_name", $db_username, $db_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connect success";
} catch (PDOException $e) {
    echo "error connection" . $e->getMessage();
}
