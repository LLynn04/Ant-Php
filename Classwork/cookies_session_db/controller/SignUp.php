<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../db/data.php';
$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? htmlspecialchars($_POST['confirm_password']) : '';
    $profile_image = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($profile_image)) {
        $errorMessage = 'all field required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'invalid Email';
    } else if ($password != $confirm_password) {
        $errorMessage = 'confirm_password must be same as password';
    } else {
        if ($profile_image && $profile_image['error'] === 0) {
            $fileName = $profile_image['name'];
            $fileTmpPath = $profile_image['tmp_name'];
            $fileType = $profile_image['type'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $uploadDir = 'storage/';
            $typeAllow = ['png', 'jpg', 'jpeg'];

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            if (!in_array($fileExt, $typeAllow)) {
                echo 'Invalid file type. Only JPG, JPEG, PNG allowed.';
                return;
            }
            do {
                $newFilename = uniqid() . '.' . $fileExt;
                $filePath = $uploadDir . $newFilename;
            } while (file_exists($filePath));

            if (move_uploaded_file($fileTmpPath, $filePath)) {

                try {
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                    $sql = 'INSERT INTO users (username, email, password, profile_image) VALUES (:username, :email, :password, :profile_image);';
                    $stmt = $connect->prepare($sql);
                    $stmt->execute([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashPassword,
                        'profile_image' => $newFilename
                    ]);
                    $successMessage = 'data sent success';
                    header("Location: /Classwork/cookies_session_db/controller/Login.php");
                } catch (PDOException $e) {
                    $errorMessage = 'error sent data' . $e->getMessage();
                }
            } else {
                $errorMessage = 'Please upload a valid image.';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }

        form {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
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

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Sign Up</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="message error"><?= $errorMessage ?></div>
        <?php elseif (!empty($successMessage)): ?>
            <div class="message success"><?= $successMessage ?></div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password">

        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="confirm_password">

        <label for="profile">Profile Image</label>
        <input type="file" id="profile" name="profile_image" accept="image/*">

        <input type="submit" value="Create Account">
    </form>

</body>

</html>