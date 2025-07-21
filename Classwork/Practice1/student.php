<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $grade = $_POST['grade'];

    if ($name != '' && is_numeric($grade) && $grade > 0 && $grade < 100) {
        $newStudent = [
            'name' => $name,
            'grade' => $grade,
        ];
        $file = 'data.json';

        if (file_exists($file)) {
            $jsonData = file_get_contents($file);
            $dataArray = json_decode($jsonData, true);
        } else {
            $dataArray = [];
        }

        $dataArray[] = $newStudent;

        file_put_contents($file, json_encode($dataArray, JSON_PRETTY_PRINT));

        echo 'data send succesed';
    } else {
        echo 'you requst required';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade">

        <input type="submit" value="Submit">
    </form>
</body>

</html>