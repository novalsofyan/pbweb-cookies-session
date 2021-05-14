<?php
session_start();
require 'connectDatabase.php';

//cek cookie
if(isset($_COOKIE['uid']) && isset($_COOKIE['token'])) {
    $uid = $_COOKIE['uid'];
    $token = $_COOKIE['token'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $uid");
    $row = mysqli_fetch_assoc($result);

    if($token === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if(isset($_POST["masuk"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION["login"] = true;

            //cek cookies 'ingat saya'
            if (isset($_POST['remember'])) {
                //buat cookies

                setcookie('uid', $row['id'], time()+(60*8000));
                setcookie('token', hash('sha256', $row['username']), time()+(60*8000));
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h1>Halman Login</h1>

    <form action="" method="post">
    
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </li>

            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat Saya</label>
            </li>
            <li>
                <button type="submit" name="masuk">Login</button>
            </li>
        </ul>

    </form>

    <?php if (isset($error)) :?>
        <p style="color: red; font-style: italic"> Username / Password Salah</p>
    <?php endif;?>

    <p>Tidak punya akun? <a href="registrasi.php">Daftar di sini</a></p>

</body>
</html>