<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
$final = [];

$hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
foreach ($hobbies as $hobby) {
    $final []= htmlspecialchars($hobby) . ', ';
}
echo "You selected:<br>" . implode('<br>', $final);

?>
<!DOCTYPE html>
<html>
<head><title>Hobbies Form</title></head>
<body>

<h2>Select Your Hobbies</h2>
<form action="" method="POST">
  <label><input type="checkbox" name="hobbies[]" value="Reading"> Reading</label><br>
  <label><input type="checkbox" name="hobbies[]" value="Gaming"> Gaming</label><br>
  <label><input type="checkbox" name="hobbies[]" value="Cooking"> Cooking</label><br>
  <label><input type="checkbox" name="hobbies[]" value="Traveling"> Traveling</label><br><br>
  <button type="submit">Submit</button>
</form>

</body>
</html>
