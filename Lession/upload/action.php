<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include './db/db.php';
$result = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== 0) {
        echo '❌ No file uploaded or upload error.';
        return;
    }

    $file = $_FILES['file'];
    $fileTmpPath = $file['tmp_name'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $typeAllow = ['png', 'jpg', 'jpeg'];
    $uploadDir = 'storage/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    if ($fileSize > 5000000) {
        echo 'Your file is too large.';
        return;
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
        echo '✅ File uploaded successfully.';

        try {
            $sql = 'INSERT INTO file_upload (file_name) VALUES (:file_name)';
            $stmt = $connect->prepare($sql);
            $stmt->execute([
                'file_name' => $newFilename
            ]);

            $sql = 'SELECT * FROM file_upload';
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    } else {
        echo '❌ Failed to move file.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Preview</title>
</head>

<body>
    <?php if (!empty($result)) : ?>
        <?php foreach ($result as $row): ?>
            <img src="storage/<?= htmlspecialchars($row['file_name']) ?>" alt="" width="150" style="margin: 5px;" />
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>