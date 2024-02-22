<?php

require "dbBroker.php";
require "model/trening.php";
require "model/clan.php";
require "model/trener.php";

session_start();

if(empty($_SESSION['clan']) || $_SESSION['korisnik'] == ''){
	header("Location: login.php");
	die();
}

$kor = $_SESSION['korisnik'];
$result = Trening::sledeciTrening($_SESSION['korisnik'], $conn);

if(!$result){
	echo "<script>alert('Greska kod upita');</script>";
}

if($result->num_rows == 0){
	echo "<script>alert('Niste zakazali trening');</script>";
	die();
}

$treneri = Trener::getAll($conn);

if(!$treneri){
	echo "<script>alert('Greska kod upita');</script>";
}

if ($treneri->num_rows == 0){
    echo "<script>alert('Nema trenera');</script>";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Konjarnik GYM</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
		    /* Center and move the login container on the page */
			.container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: relative;
        top:20%;
    }

    /* Style the logo image */
    img {
        width: 40%; /* 40% smaller */
        display: block;
        margin: 0 auto; /* center the image */
        align-self: flex-start; /* place the image on top */
    }

    /* Style the text block */
    .text-block {
        background-color: #343541;
        color: white;
        padding: 20px;
        margin: 20px;
        width: 60%;
    }

    
</style>
</head>
<body>
    <div class="container">
        <img src="logoKonjarnik.png" alt="logo">
        <div class="text-block">
		<p><?php echo date('Y-m-d H:i:s');?><br> Dobrodosli  <?php echo $kor; ?>!<br>Elitna teretana Konjarnik svojim clanovima pruza maksimalnu satisfakciju rada na najkvalitetnijim masinama, dobro osvezene prostorije i najzgodnije dame na istocnoj strani Beograda!<br> Zakazite svoj trening odmah!</p>
    <table>
      <tr>
        <th>Datum</th>
        <th>Vreme</th>
        <th>Trener</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['datum']; ?></td>
                <td><?php echo $row['vreme']; ?></td>
				<td><?php echo $row['ime']; ?></td>
</tr>
<?php
}
?>
</table>
<div class="btns">
<form action="zakaziTrening.php" method="get">
  <input type="submit" value="Zakazi Trening">
</form>
<form action="listatrenera.php" method="get">
  <input type="submit" value="Lista trenera">
</form>
</div>
</div>
<style>
  
  table {
    width: 80%; 
    margin: 0 auto; 
    border-collapse: collapse; 
  }
  
  th {
    background-color: #343541; 
    color: white; 
    padding: 10px; 
    text-align: left; 
  }
 
  td {
    background-color: #444654; 
    color: white; 
    padding: 10px; 
  }
  
  button {
    background-color: #343541; 
    color: white; 
    padding: 10px 20px; 
    margin: 10px 0; 
    border: none; 
    cursor: pointer; 
  }
  
  button:hover {
    background-color: #444654; 
  }
  
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  /* stilizacija teksta*/
  p {
    font-size: 1.6em;
    text-align: center;
    margin: 20px 0;
  }
  /
  .btns {
    display: flex;
    justify-content: center;
  }
</style>
<div class="card-footer" style="text-align: center; color:white;">
				<div class="d-flex justify-content-center links">
					 <a href="logout.php" style="color: white">LOG OUT</a>
				</div>

</body>
</html>

