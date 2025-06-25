<?php
$fruits = array("Apple", "Banana", "Orange", "Mango", "Pineapple");

$images = array(
    "Apple" => "./img/apple.jpg",
    "Banana" => "./img/banana.jpg",
    "Orange" => "./img/orange.jpg",
    "Mango" => "./img/mango.jpg",
    "Pineapple" => "./img/pineapple.jpg"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh; gap: 10px;">
        <?php
        foreach ($fruits as $fruit) {
            echo '<div class="card" style="width: 18rem; height: 10rem; margin-bottom: 10px;">';
            echo '<img src="' . $images[$fruit] . '" class="card-img-top" alt="' . $fruit . '">';
            echo '<div class="card-body">';
            echo '<p class="card-text">' . $fruit . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>