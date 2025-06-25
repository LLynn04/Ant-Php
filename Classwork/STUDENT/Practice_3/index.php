<?php
$students = [
    ["name" => "Alice", "score" => 85],
    ["name" => "Bob", "score" => 65],
    ["name" => "Charlie", "score" => 90],
    ["name" => "Diana", "score" => 72],
];
$average_score = 70;

for ($i = 0; $i < count($students); $i++) {
    $students[$i]["status"] = $students[$i]["score"] >= $average_score ? "Passed" : "Failed";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Student Results</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .results-table {
            margin: 20px auto;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Student Results</h1>
        <div class="results-table">
            <table class="table table-bordered">
                <thead class="table-header">
                    <tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Score</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['score']; ?></td>
                            <td class="<?php echo $student['status'] === 'Passed' ? 'text-success' : 'text-danger'; ?>">
                                <?php echo $student['status']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>