<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// practice1
// $final = [];
// $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
// foreach ($hobbies as $hobby) {
//     $final []= htmlspecialchars($hobby) . ', ';
// }
// echo "You selected:<br>" . implode('<br>', $final);

// prctice2
// $country = isset($_GET['country']) ? htmlspecialchars($_GET['country']): '';
// echo $country;

// practice3
// $password = 1234;
// $username = 'admin';
// if (isset($_POST['username']) && isset($_POST['password'])) {
//   if ($_POST['username'] == '' || $_POST['password'] == '') {
//     echo 'input value';
//   } else {
//     if ($_POST['username'] == $username && $_POST['password'] == $password){
//       echo 'success';
//     } else {
//       echo 'failed';
//     }
//   }
// }

$search = isset($_GET['query'])? htmlspecialchars($_GET['query']): '';
echo $search;

?>
<!-- prctice1 -->
<!-- <!DOCTYPE html>
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
</html> -->

<!-- practice2 -->
<!-- <!DOCTYPE html>
<html>
<head><title>Country Select</title></head>
<body>

<h2>Choose Your Country</h2>
<form action="" method="GET">
  <select name="country">
    <option value="">-- Select --</option>
    <option value="Cambodia">Cambodia</option>
    <option value="USA">USA</option>
    <option value="Japan">Japan</option>
    <option value="France">France</option>
  </select>
  <button type="submit">Go</button>
</form>

</body>
</html> -->

<!-- practice3 -->
<!-- <!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>

<body>

  <h2>Login Form</h2>
  <form action="" method="POST">
    <label>Username: <input type="text" name="username"></label><br><br>
    <label>Password: <input type="password" name="password"></label><br><br>
    <button type="submit">Login</button>
  </form>

</body>

</html> -->

<!DOCTYPE html>
<html>
<head><title>Search</title></head>
<body>

<h2>Search</h2>
<form action="" method="GET">
  <input type="text" name="query" placeholder="Type search term">
  <button type="submit">Search</button>
</form>

</body>
</html>

