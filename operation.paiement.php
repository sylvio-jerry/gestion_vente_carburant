<?php 
    require('connection.php');
    global $mysqli;

    function listeDate(){
        global $mysqli;
        $sql = "SELECT DISTINCT year(dateachat) as dateA FROM achat ORDER BY dateA;";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res; 
        }
    }

    function listePaiement(){
        global $mysqli;
        $sql = "SELECT DISTINCT sum(qte*pu) as nb, achat.modepaie FROM achat achat, 
                carburant c WHERE achat.numcarburant = c.numcarburant GROUP BY modepaie";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res; 
        } else {
            echo "error";
        }
    }
?>