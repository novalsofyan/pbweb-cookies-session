<?php

require 'connectDatabase.php';

if(isset($_POST["register"])) {

    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);

    //cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!');
            </script>";
        echo "<script> setTimeout(function() { window.open('registrasi.php','_self') }, 100) </script>";
        return false;
    }

    if ($password !== $password2) {

        echo "<script>
                alert('password tidak sesuai!');
              </script>";
    
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (id, username, password) VALUES (NULL, '$username', '$password')";
        mysqli_query($conn, $sql);
        echo "<script>
                alert('user baru berhasil ditambahkan!');
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>

    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
    
        <ul>
            <li>
                <label for="username">username: </label>
                <input type="text" name="username" id="username">
            </li>

            <li>
                <label for="password">password: </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">konfirmasi password: </label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="register">Daftar</button>
            </li>
        </ul>

    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

</body>
</html>