<?php
session_start();

if ( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman 2</title>
</head>
<body>
    <h1>Halo User</h1>
    <p>Ini halaman 2</p>
    <a href="index.php">Kembali ke index</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>