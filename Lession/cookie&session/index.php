<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$valid_username = 'Ganggang';
$valid_password = '123456';
$message = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
//     $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

//     if ($username === $valid_username && $password === $valid_password) {
//         setcookie("username", $username, time() + (7 * 24 * 60 * 60));

//         header("Location: /Lession/cookie&session/homepage.php");
//         $message = 'success';
//     } else {
//         $message = 'invalid pass or username';
//     }
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = isset($_POST['username'])? htmlspecialchars($_POST['username']): '';
    $password = isset($_POST['password'])? htmlspecialchars($_POST['password']): '';

    if($username === $valid_username && $password === $valid_password){
        $_SESSION['username'] = $username;

        header("Location: /Lession/cookie&session/homepage.php");
    } else {
        $message = 'failed';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php echo $message ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username">

        <label>Password:</label>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>