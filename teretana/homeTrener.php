<?php

require "dbBroker.php";
require "model/trening.php";

session_start();

if(empty($_SESSION['trener']) || $_SESSION['trener'] == ''){
	header("Location: login.php");
	die();
}

$result = Trening::sveOdTrenera($_SESSION['trener'], $conn);

if(!$result){
	echo "Greska kod upita";
}

if($result->num_rows == 0){
	echo "Nema zakazanih treninga";
	die();
}



?>

<!DOCTYPE html>
<html>
  <head>
    <title>Dobrodosao, Trener</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="homeTrener.js"></script>


    <style>
      table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
      }
      th, td {
        border: 1px solid #ddd;
        padding: 8px;
      }
      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>
  <body>
    <h1 style="text-align: center">Lista treninga</h1>
	<div>
  <label for="ime">Ime:</label>
  <input type="text" id="ime" name="ime">
  <button id="filter-button" style="border: 1px solid white">Isfiltriraj</button>

</div>

    <table id="trainings-table">
      <tr style="color: black">
        <th>Datum</th>
        <th>Vreme</th>
        <th>Korisnik</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr style="color: white">
          <td><?= $row['datum'] ?></td>
          <td><?= $row['vreme'] ?></td>
          <td><?= $row['ime'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
    <div style="text-align: center; margin-top: 20px;">
      <form action="logout.php" method="post">
        <button type="submit">LOG OUT</button>
      </form>
    </div>
  </body>
</html>
