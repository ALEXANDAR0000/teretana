<?php

$host = "localhost";
$db = "teretana";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_errno){
    exit("Neuspesna konekcija s bazom podataka: " . $conn->connect_errno);
    }



?>