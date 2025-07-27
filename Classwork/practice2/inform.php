<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'action.php';
$successMessage = '';
$errorMessage = '';
$isEdit = false;

// fetch all show user 
$sql = 'SELECT * FROM users';
$stmt = $connect->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// delete row by id
if (isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];

    $sql = 'DELETE FROM users Where id = :id';
    $stmt = $connect->prepare($sql);
    $stmt->execute([
        'id' => $deleteID
    ]);
    $successMessage = 'delete successfuly';
}

// check database
if (isset($_GET['edit_id'])) {
    $editID = $_GET['edit_id'];

    $sql = 'SELECT * FROM users Where id = :id';
    $stmt = $connect->prepare($sql);
    $stmt->execute([
        'id' => $editID
    ]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($editUser) {
        $isEdit = true;
    } else {
        $errorMessage = 'user not found';
    }
}

$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? htmlspecialchars($_POST['confirm_password']) : '';


if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = 'invalid email';
} else if ($isEdit && isset($_POST['edit_id'])) {
    if (empty($name) && empty($email)) {
        $errorMessage = 'feild required';
    } else {
        try {
            $sql = 'UPDATE users SET name = :name, email = :email Where id = :id';
            $stmt = $connect->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'id' => $_POST['edit_id'],
            ]);


            $successMessage = 'Updated successfully';
            header("Location: " . $_SERVER['PHP_SELF']);
        } catch (PDOException $e) {
            echo 'error' . $e->getMessage();
        }
    }
} else {
    // crtate
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $errorMessage = 'filed requird';
    } else if ($password != $password) {
        $errorMessage = 'password must be same';
    } else {
        try {
            $hoshPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password);';
            $stmt = $connect->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hoshPassword,
            ]);

            $successMessage = 'created successfuly';
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (PDOException $e) {
            echo 'error' . $e->getMessage();
        }
    }
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
        <?php if ($isEdit && isset($editUser)): ?>
            <input type="hidden" name="edit_id" value="<?= $editUser['id'] ?>" />
        <?php endif; ?>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $isEdit ? htmlspecialchars($editUser['name']) : '' ?>" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $isEdit ? htmlspecialchars($editUser['email']) : '' ?>" />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" />

        <input type="submit" value="<?= $isEdit ? 'Update' : 'Register' ?>" />
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