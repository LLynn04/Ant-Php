<?php
session_start();

include '../db/data.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
$errorMessage = '';
$successMessage = '';

$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($email) || empty($password)) {
        $errorMessage = 'required';
    } else {
        try {
            $sql = 'SELECT * FROM users Where email = :email';
            $stmt = $connect->prepare($sql);
            $stmt->execute([
                'email' => $email
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: /Classwork/cookies_session_db/controller/Profile.php");
                exit;
            } else {
                $errorMessage = 'invalid password';
            }
        } catch (PDOException $e) {
            $errorMessage = 'fail send data' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f0f0f0;
        }

        form {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <form action="" method="POST">
        <h2 style="text-align:center">Login</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="message error"><?= $errorMessage ?></div>
        <?php elseif (!empty($successMessage)): ?>
            <div class="message success"><?= $successMessage ?></div>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>

</body>

</html>