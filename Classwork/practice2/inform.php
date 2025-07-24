<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'action.php';
$errorMessage = '';
$successMessage = '';
$editeMode = false;
$editeName = '';
$editeEmail = '';
$editePassword = '';

if (isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];

    $sql = 'DELETE FROM users WHERE id = :id';
    $statement = $connect->prepare($sql);
    $statement->bindParam(':id', $deleteID, PDO::PARAM_INT);

    if ($statement->execute()) {
        $successMessage = "User deleted successfully.";
    } else {
        $errorMessage = "Failed to delete user.";
    }
}

if (isset($_GET['edit_id'])) {
    $editMode = true;
    $editId = $_GET['edit_id'];

    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connect->prepare($sql);
    $statement->bindParam(':id', $editId, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $errorMessage = "User not found.";
    }
}

$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? htmlspecialchars($_POST['confirm_password']) : '';

if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $errorMessage =  'file required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = 'invalid Email';
} elseif ($password != $confirm_password) {
    $errorMessage = 'password must same as confirm_password';
} elseif (isset($_GET['edit_id'])) {
    try {
        $editId = $_GET['edit_id'];

        $sql = "UPDATE users SET name=:name, email=:email, password=:password Where id= :id";
        $statement = $connect->prepare($sql);
        $data = [
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':id' => $editId
        ];


        $users = $statement->execute($data);
        if ($users) {
            $successMessage = 'update success';
        } else {
            $errorMessage = 'failed';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    try {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $statement = $connect->prepare("INSERT INTO users (name,email,password) VALUES (:name , :email , :password );");
        $users = $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashPassword
        ]);
        $successMessage = 'signup success';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

try {
    $sql = "SELECT id, name, email, password from users";
    $statement = $connect->prepare($sql);
    $users = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'failed' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Register User</title>
    <style>
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        label,
        input {
            display: block;
            width: 100%;
            margin-bottom: 12px;
        }

        input[type="submit"] {
            width: auto;
            padding: 8px 20px;
        }

        .message {
            max-width: 400px;
            margin: 20px auto;
            padding: 12px;
            border-radius: 6px;
        }

        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #888;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .delete-btn {
            background-color: red;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Register User</h2>

    <?php if (!empty($errorMessage)): ?>
        <div class="message error"><?= $errorMessage ?></div>
    <?php elseif (!empty($successMessage)): ?>
        <div class="message success"><?= $successMessage ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"/>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($user['password']) ?>"/>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" />

        <input type="submit" value="<?= $editMode ? 'Update' : 'Register' ?>" />
    </form>

    <h2>All Users</h2>

    <?php if (!empty($users)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $data): ?>
                    <tr>
                        <td><?= htmlspecialchars($data['id']) ?></td>
                        <td><?= htmlspecialchars($data['name']) ?></td>
                        <td><?= htmlspecialchars($data['email']) ?></td>
                        <td><?= htmlspecialchars($data['password']) ?></td>
                        <td>
                            <a class="edit-btn" href="?edit_id=<?= $data['id'] ?>">Edit</a>
                            <a class="delete-btn" href="?delete_id=<?= $data['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center; color:gray;">No users found.</p>
    <?php endif; ?>

</body>

</html>