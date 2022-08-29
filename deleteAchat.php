<?php 
    require_once('connection.php');
    global $mysqli;

    if(isset($_GET['SupCodeCli'])){
        $SupCodeCli = $_GET['SupCodeCli'];
        $SupCodeCrb = $_GET['SupCodeCrb'];
        $qteAchat = $_GET['SupQte'];
        
        $req = "DELETE FROM achat WHERE codecli = '$SupCodeCli' AND numcarburant = '$SupCodeCrb';";
        $res = $mysqli->query($req);
        if($res){
            $sql2 = "UPDATE carburant SET stock = stock + $qteAchat WHERE numcarburant = '$SupCodeCrb';";
            mysqli_query($mysqli, $sql2);
            header('location: achat.php');
        }
    }
?>