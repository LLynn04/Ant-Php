<?php
// find error in this codes
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db_server = 'localhost';
$db_username = 'root';
$db_name = 'mysql1';
$db_password = 'Linmeng@2003';

// using msqli
// try {
//     $db = new mysqli($db_server, $db_username, $db_password, $db_name);
// } catch (mysqli_sql_exception) {
//     echo "Database connection failed: ";
// }
//   if ($db){
//         echo "Database connection successful.";
//     }

// using PDO
try {
    $db = new PDO("mysql:host=$db_server; dbname=$db_name", $db_username, $db_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Database connection successful.<br>";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>