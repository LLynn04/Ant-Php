<?php
session_start();
include '../db/data.php';
$user = [];

if (!isset($_SESSION['user_id'])) {
  header("Location: /Classwork/cookies_session_db/controller/Login.php");
  exit;
}

$sql = 'SELECT * FROM users';
$stmt = $connect->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Users</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }
    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 10px;
      border: 3px solid #4CAF50;
    }
    .card h2 {
      font-size: 18px;
      margin: 0;
    }
    .card p {
      color: #555;
      margin: 5px 0;
    }
  </style>
</head>
<body>

<h1>All Users</h1>
<div class="container">
  <?php foreach ($user as $users): ?>
    <div class="card">
      <img src="storage/<?= htmlspecialchars($users['profile_image']) ?>" alt="Profile Image">
      <h2><?= htmlspecialchars($users['username']) ?></h2>
      <p><?= htmlspecialchars($users['email']) ?></p>
    </div>
  <?php endforeach; ?>
</div>

</body>
</html>
