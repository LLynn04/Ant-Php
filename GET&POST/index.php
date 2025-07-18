<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }
        form {
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .gender-group {
            margin-bottom: 16px;
        }
        .gender-group label {
            display: inline-block;
            margin-right: 16px;
            font-weight: normal;
        }
        input[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<form action="./action.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" >

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" >

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;">

    <label for="date">Date of Birth:</label>
    <input type="date" id="date" name="date">

    <div class="gender-group">
        <label>Gender:</label>
        <label><input type="radio" name="gender" value="Male"> Male</label>
        <label><input type="radio" name="gender" value="Female"> Female</label>
        <label><input type="radio" name="gender" value="Other"> Other</label>
    </div>

    <input type="submit" value="Submit">
</form>

</body>
</html>