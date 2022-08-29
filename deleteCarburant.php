<?php 
    require_once('connection.php');
    global $mysqli;

    if(isset($_GET['SupCrb'])){
        $SupCrb = $_GET['SupCrb'];
        $req = "DELETE FROM carburant WHERE numcarburant = '$SupCrb';";
        $res = $mysqli->query($req);
        if($res){
            header('location: carburant.php');
        }
    }
?>