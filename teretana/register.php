<?php

require 'dbBroker.php';
require 'model/clan.php';
require 'model/trener.php';

if (isset($_POST['submit'])) {

    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $ime = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password1 = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password == $password1) {

        $result = Clan::check($user, $conn);
        $resultTr = Trener::check($user, $conn);

        if (mysqli_num_rows($result) != 0) {
            echo "<script>alert('Korisnicko ime je zauzeto');</script>";
        } else {
            if (mysqli_num_rows($resultTr) != 0) {
                echo "<script>alert('Korisnicko ime je zauzeto');</script>";

            } else {

                Clan::add($ime, $email, $user, $password, $conn);
                header("location: login.php");
            }
        }
    } else {

        echo "<script>alert('Sifre se ne poklapaju');</script>";
    }

}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Registruj se</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <input type="submit" name="submit" value="REGISTER">
    </form>

    <div class="card-footer" style="text-align: center; color:white;">
        <div class="d-flex justify-content-center links">
            Vec ste registrovani? <a href="login.php" style="color: white">Prijavite se</a>
        </div>

    </div>

</body>

</html>