<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('uid', '', time() - 3600);
setcookie('token', '', time() - 3600);

header("Location: login.php");

?>