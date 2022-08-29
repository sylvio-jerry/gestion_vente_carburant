<?php 

    if(isset($_GET['ans'])){
        $annee = $_GET['ans'];
        $req = "SELECT * FROM achat WHERE dateachat = '$annee";
        $res = mysqli_query($mysqli, $req);

        while($row = mysqli_fetch_assoc($res)){
            $codecli = $row['codecli'];
            $numCrb = $row['numcarburant'];
            $qte = $row['qte'];
            $date = $row['dateachat'];
            $paie = $row['modepaie'];
        }   
    }

?>