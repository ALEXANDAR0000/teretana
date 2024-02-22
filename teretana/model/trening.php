<?php

class Trening{

    public $datum;
    public $vreme;
    public $trener;
    public $clan;

public function __construct($datum, $vreme, $trener, $clan){

    $this->datum = $datum;
    $this->vreme = $vreme;
    $this->trener = $trener;
    $this->clan = $clan;
}

public function dodaj(mysqli $conn) {  //NIJE STATICKA FUNKCIJA, MOZDA BI BILO BOLJE DA JESTE, PROVERI
    if (self::jelSlobodno($this->datum, $this->vreme, $this->trener, $conn)) {
        $upit = "insert into trening (datum, vreme, trener, clan) values ('$this->datum', $this->vreme, '$this->trener', '$this->clan');";
        return $conn->query($upit);
    } else return false;
}


public static function jelSlobodno($datum, $vreme, $trener, mysqli $conn){
    $upit = "SELECT COUNT(*)
    FROM trening 
    WHERE datum = '$datum' 
    AND vreme = $vreme 
    AND trener = '$trener';";
    $rezultat = $conn->query($upit);
    if ($rezultat === false) {
        return false;
    }
    $count = $rezultat->fetch_row()[0];
    if ($count > 0) return false;
    return true;
}


public static function sveOdTrenera($trener, mysqli $conn){
    $upit = "SELECT trening.datum, trening.vreme, clan.ime
    FROM trening
    JOIN clan ON trening.clan = clan.username
    WHERE trening.trener = '$trener'
    ORDER BY trening.datum ASC;";
    return $conn->query($upit);
}

public static function sveOdTreneraFilter($trener, mysqli $conn, $ime){
    $query = "SELECT trening.datum, trening.vreme, clan.ime FROM trening
JOIN clan ON trening.clan = clan.username WHERE clan.ime LIKE '%$ime%' AND trening.trener = '$trener'; ";

return $conn->query($query);
}

public static function sledeciTrening($clan, mysqli $conn){
    $upit = "SELECT trening.datum, trening.vreme, trener.ime
            FROM trening
            JOIN trener ON trening.trener = trener.username
            WHERE trening.clan = '$clan'
            ORDER BY trening.datum ASC
            LIMIT 1;";
    return $conn->query($upit);

}

public static function otkaziTrening($trener, $datum, $vreme, mysqli $conn){
    $upit = "DELETE FROM trening WHERE trener = '$trener' AND datum = '$datum' AND vreme = $vreme";
    return $conn->query($upit);
}

public static function ocisti(mysqli $conn){
    $current_date = date('Y-m-d');
    $query = "DELETE FROM trening WHERE datum < '$current_date'";
    $conn->query($query);
}

// public function otkaziTrening(mysqli $conn) {
//     $upit = "DELETE FROM trening WHERE trener = '$this->trener' AND datum = '$this->datum' AND vreme = $this->vreme";
//     return $conn->query($upit);
// }





}




?>