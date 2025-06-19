<?php
$firstName = "Kouk";
$lastName = "Lin";
$profile = "./image/profile.jpg";
$email = "johnjammi@gmail.com";
$gender = "Male";
$description = "Technology refers to the practical application of scientific knowledge to create tools, systems, and processes that solve problems, enhance human capabilities, and streamline complex tasks. It is a driving force behind innovation and societal transformation.";
$image = ["./image/image1.jpg", "./image/image2.jpg", "./image/image3.jpg"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?> - CV</title>
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .cv-container {
            background: #fff;
            width: 700px;
            height: 90vh;
            margin: 40px auto;
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cv-header {
            display: flex;
            align-items: center;
            padding: 32px 40px 0 40px;
            text-align: left;
        }

        .profile-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0078d7;
            margin-right: 24px;
        }

        .cv-header-info h1 {
            margin: 0 0 8px 0;
            font-size: 2em;
            color: #222;
            
        }

        .cv-header-info p {
            margin: 4px 0;
            color: #555;
        }

        .cv-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cv-description {
            text-align: left;
            color: #444;
            font-size: 1.15em;
            line-height: 1.6;
            max-width: 80%;
            margin: 0 auto;
        }

        .cv-footer {
            padding: 32px 40px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: center;
            gap: 28px;
            background: #fafafa;
            border-radius: 0 0 10px 10px;
        }

        .cv-footer img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="cv-container">
        <div class="cv-header">
            <img class="profile-img" src="<?php echo $profile; ?>" alt="Profile">
            <div class="cv-header-info">
                <h1><?php echo $firstName . ' ' . $lastName; ?></h1>
                <p><strong>Email: </strong> <?php echo $email; ?></p>
                <p><strong>Gender: </strong> <?php echo $gender; ?></p>
            </div>
        </div>
        <div class="cv-body">
            <div class="cv-description">
                <!-- Displays the description if available; otherwise, shows a fallback message  -->
                <?php echo $description ? $description : '<em>No description provided.</em>'; ?>
            </div>
        </div>
        <div class="cv-footer">
            <?php foreach ($image as $img): ?>
                <img src="<?php echo $img; ?>" alt="Footer Image">
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>