<?php
    require('connection.php');
    global $mysqli;

    function listeDonneAchat(){
        global $mysqli;
        $sql = "SELECT achat.*
                FROM carburant c, client cli, achat achat 
                WHERE (c.numcarburant = achat.numcarburant) AND (cli.codecli = achat.codecli);";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res; 
        }
    }

    function message($class, $msg){
        echo "<h4 class='$class text-center'>$msg</h4>";
    }

    function listeAchatCarburant(){
        global $mysqli;
        $sql = "SELECT design, nomcli, dateachat, pu, qte, pu*qte as montant
                FROM carburant c, client cli, achat achat 
                WHERE (c.numcarburant = achat.numcarburant) AND (cli.codecli = achat.codecli);";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res; 
        }
    }

    // function listeVente(){
    //     global $mysqli;
    //     $m = 2020;

    //     $sql = "SELECT cli.*, dateachat FROM client cli, achat achat 
    //             WHERE (cli.codecli = achat.codecli) AND year(dateachat) = $m;";
    //     $res = mysqli_query($mysqli, $sql);
    //     if($res){
    //         return $res; 
    //     } else {
    //         echo "Erreur...";
    //     }
    // }

    function Montant(){
        global $mysqli;
        $sql = "SELECT  pu, qte, sum(pu*qte) as total
                FROM carburant c, achat achat 
                WHERE (c.numcarburant = achat.numcarburant)";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res; 
        }
    }

    function listeCodeCli(){
        global $mysqli;
        $sql = "SELECT codecli, nomcli FROM client;";
        $res = mysqli_query($mysqli, $sql);
        return $res;
    }

    function listeCodeCarburant(){
        global $mysqli;
        $sql = "SELECT numcarburant, design FROM carburant;";
        $res = mysqli_query($mysqli, $sql);
        return $res;
    }

    if(isset($_POST['ajouterAchat'])){
        ajoutAchat();
    }

    function ajoutAchat(){
        global $mysqli;
        $codecli = mysqli_real_escape_string($mysqli, trim($_POST['numcliAchat']));
        $numCrbAchat = mysqli_real_escape_string($mysqli, trim($_POST['numCrbAchat']));
        $modepaie = mysqli_real_escape_string($mysqli, trim($_POST['modepaie']));
        $dateAchat = mysqli_real_escape_string($mysqli, trim($_POST['dateAchat']));
        $qteAchat = $_POST['qteAchat'];

        if($codecli && $numCrbAchat && $qteAchat && $dateAchat){
            $sql = "INSERT INTO achat(codecli, numcarburant, qte, dateachat, modepaie)
                    VALUES('$codecli', '$numCrbAchat', $qteAchat, '$dateAchat','$modepaie');";
            
            if(mysqli_query($mysqli, $sql)){
                $sql2 = "UPDATE carburant SET stock = stock - $qteAchat WHERE numcarburant = '$numCrbAchat'";
                mysqli_query($mysqli, $sql2);
            
                $_SESSION['status']="ajout avec success";
                $_SESSION['status_code']="success";    
            } else {
                $_SESSION['status']="Erreur d'ajout";
                $_SESSION['status_code']="error";    
            }
        } else {
            $_SESSION['status']="Veuillez remplir les champs vide";
            $_SESSION['status_code']="warning";    
        }
    }
?>