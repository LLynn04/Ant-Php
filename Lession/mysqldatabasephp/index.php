<pre></pre><?php
            // phpinfo();
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include 'data.php';
            // echo "Welcome to the index page!<br>";
            // $sql = "INSERT INTO users (username, email, password)
            // VALUES 
            // ('John Doe', 'didi@gmail.com', '123456'),
            // ('John jame', 'jame@gmail.com', '12344444')
            // ";

            // $sql = "DELETE FROM `users` WHERE `username` = 'John jame'";

            // $sql = "UPDATE `users` SET `username` = 'Katty Perry', `email` = 'jame@gmail.com', `password` = '1234445' WHERE `id` = '2'";

            // mysqli_query($db, $sql);
            $db->query("INSERT INTO users (username, email, password)
 VALUES ('John Doe', 'daling@gmail,com', '123456')");

            $statement = $db->query("SELECT id, username from users");
            $user_list = $statement->fetchAll();

            foreach ($user_list as $user) {
                echo 'your id: ' .  $user['id'] . ': ' . 'and name: ' . $user['username'] . '<br/>';
            }

            echo '<br/>';

            $statement2 = $db->prepare("SELECT id, username from users");
            $statement2->execute();
            $user_list2 = $statement2->fetchAll();
            foreach ($user_list2 as $user2) {
                echo 'your id: ' .  $user2['id'] . ': ' . 'and name: ' . $user2['username'] . '<br/>';
            }

            ?>
<pre />