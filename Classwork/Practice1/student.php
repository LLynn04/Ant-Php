<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $grade = $_POST['grade'];

   if (!empty($name) && is_numeric($grade) && $grade > 0 && $grade < 100) {
        
        $file = 'data.json';
        $jsonData = file_exists($file)? file_get_contents($file): [];

        $data = json_decode($jsonData, true);
        $dataStudent = [
            'name' => $name,
            'grade' => $grade,
        ];
        
        $data[] = $dataStudent;
        $newJsondata = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($file, $newJsondata);

        echo "successed";
    } else {
        echo "failed";
    }
    exit;
}

header('Content-Type: application/json');

$file = 'data.json';
$jsonData = file_exists($file) ? file_get_contents($file) : '[]';
$data = json_decode($jsonData, true);

$minGrade = isset($_GET['min_grade']) ? (int)$_GET['min_grade'] : 0;
$filtered = array_filter($data, function($student) use ($minGrade) {
    return $student['grade'] >= $minGrade;
});

echo json_encode(array_values($filtered), JSON_PRETTY_PRINT);

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