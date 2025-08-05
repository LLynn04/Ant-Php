<?php
// setcookie("username", "", time() - 99999);

session_start();
session_destroy();

header("Location: /Lession/cookie&session/index.php");
exit;