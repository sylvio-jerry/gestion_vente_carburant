<?php 
    include('connection.php');
    global $mysqli;

    if(isset($_POST['editAs'])){
        $idCli = $_POST['editnumcliAchat'];
        $idCrb = $_POST['editnumCrbAchat'];

        $mod = mysqli_real_escape_string($mysqli, trim($_POST['editmodepaie']));
        $qt = $_POST['editqteAchat'];
        $dat = mysqli_real_escape_string($mysqli, trim($_POST['editdateAchat']));
       
        $sql = "UPDATE achat SET qte = $qt, dateachat = '$dat', modepaie = '$mod' WHERE codecli = '$idCli' AND numcarburant = '$idCrb';";
        $resq = mysqli_query($mysqli, $sql);

        // $sql2 = "UPDATE carburant SET stock = stock - $qt WHERE numcarburant = '$numCrbAchat'";
        // mysqli_query($mysqli, $sql2);
            
        if($resq){
            $_SESSION['status']="Modification avec success";
            $_SESSION['status_code']="success"; 
            header('location: achat.php');
        } else {
            $_SESSION['status']="Erreur de modification";
            $_SESSION['status_code']="error"; 
        }
    }
?>