<?php 
    require_once('connection.php');
    global $mysqli;

    if(isset($_GET['SupCli'])){
        $SupCli = $_GET['SupCli'];
        $req = "DELETE FROM client WHERE codecli = '$SupCli';";
        $res = $mysqli->query($req);
        if($res){
            header('location: client.php');
        }
    }
?>