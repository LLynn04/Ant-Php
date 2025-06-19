
<?php
$name = "John Doe";
$age = 30;
$location = "New York";
$hobbies = array("reading", "traveling", "coding");
$gender = "male";
$image_url = "https://files.idyllic.app/files/static/2618800?width=384&optimizer=image";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Card</title>
    <style>
        .card {
            width: 320px;
            background: gray;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            padding: 24px;
            margin: 40px auto;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            margin-bottom: 16px;
        }
        .card h2 {
            margin: 8px 0 4px 0;
            font-size: 1.5em;
            color: darkblue;
        }
        .card .info {
            color: #555;
            margin-bottom: 12px;
            color: lightgreen;
        }
        .card .hobbies {
            margin-top: 12px;
        }
        .card .hobbies span {
            background: #f0f0f0;
            border-radius: 12px;
            padding: 4px 10px;
            margin: 0 4px;
            font-size: 0.95em;
            display: inline-block;
            color: red;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="<?php echo $image_url; ?>" alt="Profile Image">
        <h2><?php echo $name; ?></h2>
        <div class="info">
            <?php echo ucfirst($gender); ?>, <?php echo $age; ?> <br>
            <?php echo $location; ?>
        </div>
        <div class="hobbies">
            <strong>Hobbies:</strong>
            <?php foreach ($hobbies as $hobby): ?>
                <span><?php echo $hobby ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>