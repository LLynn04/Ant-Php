
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$hashPassword = password_hash($password, PASSWORD_DEFAULT);
$date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
$gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';

$age = '';
if ($date) {
    $dob = new DateTime($date);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
}

echo "Name: $name<br>";
echo "Description: $description<br>";
echo "Password: $hashPassword<br>";
echo "Date of Birth: $date<br>";
echo "Age: $age<br>";
echo "Gender: $gender<br>";


?>