<?php

require "dbBroker.php";
require "model/trener.php";
require "model/clan.php";
require "model/trening.php";

session_start();

if (isset($_POST['submit'])) {

    $u = $_POST['username'];
    $p = $_POST['password'];

    Trening::ocisti($conn);

    $result = Trener::login($u, $p, $conn);

    if ($result->num_rows != 0) {
        echo "<script>alert('Uspesno ste se prijavili kao trener!');</script>";
        $_SESSION['trener'] = $u;
        header("Location: homeTrener.php");
        exit();

    } else {
        $result = Clan::login($u, $p, $conn);

        if ($result->num_rows != 0) {
            echo "<script>alert('Uspesno ste se prijavili kao clan!');</script>";
            $_SESSION['clan'] = $u;
            $_SESSION['ime'] = Clan::vratiIme($u, $conn);
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Netacno ime ili lozinka');</script>";

        }

    }


}

?>

<!DOCTYPE html>

<html>

<head>
    <title>GYM</title>
    <style>
        </head><body><div class="login-container"><form method="POST"><h1>LOG IN HERE</h1><div><label for="username">Username:</label><input type="text" id="username" name="username"><br><label for="password">Password:</label><input type="password" id="password" name="password"><br><button name="submit" type="submit">Login</button></div></form>< !-- </div><div style="text-align: center; margin-top: -8%; color:white;"><span>Nemas nalog? <a href="domaci/register.php" style="text-decoration: underline; color: white">Registruj se</a></span></div>--><div class="card-footer" style="text-align: center; color:white;"><div class="d-flex justify-content-center links">Niste registrovani? <a href="register.php" style="color: white">Registrujte se</a></div></div></body></html>