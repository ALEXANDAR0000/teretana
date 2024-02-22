<?php
require "dbBroker.php";
require "model/trener.php";

$treneri = Trener::getAll($conn);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Lista trenera</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
/* Style the table */
table {
        margin: 0 auto;
        width: 50%;
        border-collapse: collapse;
        background-color: #343541;
        color: white;
    }

    /* Style the table headers */
    th {
        border-bottom: 1px solid white;
        padding: 10px;
        font-size: 1.2em;
    }

    /* Style the table cells */
    td {
        border-bottom: 1px solid white;
        padding: 10px;
        font-size: 1.2em;
    }

    /* Style the buttons */
    .button {
        background-color: #343541;
        color: white;
        padding: 12px 20px;
        margin: 8px 0;
        width: 200px;
        display: inline-block;
        border: none; /*remove border*/
        box-sizing: border-box;
    }

    
    </style>
</head>
<body>
  <h1>Lista trenera</h1>
  <table>
    <thead>
      <tr>
        <th>Ime</th>
        <th>Iskustvo</th>
      </tr>
    </thead>
    <tbody>
      <?php while($trener = $treneri->fetch_assoc()): ?>
        <tr>
          <td><?php echo $trener['ime']; ?></td>
          <td><?php echo $trener['iskustvo']; ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="card-footer" style="text-align: center; color:white;">
				<div class="d-flex justify-content-center links">
					IDI <a href="index.php" style="color: white">NAZAD</a>
				</div>
</body>
</html>
