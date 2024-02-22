<?php
require "dbBroker.php";
require "model/trening.php";

session_start();
$ime = $_POST['ime'];

$trener = $_SESSION['trener'];

$result = Trening::sveOdTreneraFilter($trener, $conn, $ime);




if(!$result){
    echo "Greska kod upita";
}

if($result->num_rows == 0){
    echo "Nema zakazanih treninga";
    die();
}

?>

<tr>
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
