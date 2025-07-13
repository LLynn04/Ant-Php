<?php
// phpinfo();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'data.php';
// echo "Welcome to the index page!<br>";
// $sql = "INSERT INTO users (username, email, password)
// VALUES 
// ('John Doe', 'didi@gmail.com', '123456'),
// ('John jame', 'jame@gmail.com', '12344444')
// ";

// $sql = "DELETE FROM `users` WHERE `username` = 'John jame'";

$sql = "UPDATE `users` SET `username` = 'Katty Perry', `email` = 'jame@gmail.com', `password` = '1234445' WHERE `id` = '2'";

mysqli_query($db, $sql);

mysqli_close($db);
?>