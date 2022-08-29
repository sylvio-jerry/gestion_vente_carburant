<?php
    require('connection.php');
    global $mysqli;

    
    function message($class, $msg){
        echo "<h4 class='$class text-center'>$msg</h4>";
    }

    function listedonne(){
        global $mysqli;
        $sql = "SELECT * FROM carburant";
        $result = mysqli_query($mysqli, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
    
    function numCarburant(){
        $getId = listedonne();
        $id = 0;
        if($getId){
            while($row = mysqli_fetch_assoc($getId)){
                $id++;
            }
        }
        echo $id+1;
    }

    if(isset($_POST['ajoutercarburant'])){
        ajoutcarburant();
    }

    function ajoutcarburant(){
        global $mysqli;
        $num = mysqli_real_escape_string($mysqli, trim($_POST['numCrb']));
        $design = mysqli_real_escape_string($mysqli, trim($_POST['designCrb']));
        $pu = $_POST['puCrb'];
        $stock = $_POST['stockCrb'];

        if($num && $design && $pu && $stock){
            $sql = "INSERT INTO carburant(numcarburant, design, pu, stock)
                    VALUES('$num', '$design', $pu, $stock);";
            if(mysqli_query($mysqli, $sql)){
                $_SESSION['status']="ajout avec success";
                $_SESSION['status_code']="success";    
            } else {
                $_SESSION['status']="Erreur d'ajout";
                $_SESSION['status_code']="error";    
            }
        } else {
            $_SESSION['status']="Vueiller remplir les champs vide";
            $_SESSION['status_code']="error";    
        }
    }

    if(isset($_POST['modifiercarburant'])){
        modifiercarburant();
    }

    function modifiercarburant(){
        global $mysqli;
        $num = mysqli_real_escape_string($mysqli, trim($_POST['numCrb']));
        $design = mysqli_real_escape_string($mysqli, trim($_POST['designCrb']));
        $pu = $_POST['puCrb'];
        $stock = $_POST['stockCrb'];

        if($design &&  $pu && $stock){
            $sql = "UPDATE carburant SET design='$design', pu='$pu', stock = '$stock'
                    WHERE numcarburant = '$num' ";

            if(mysqli_query($mysqli, $sql)){
                $_SESSION['status']="Modification avec success";
                $_SESSION['status_code']="success";    
            } else {
                $_SESSION['status']="Echec de modification";
                $_SESSION['status_code']="error";    
            }
        } else {
            $_SESSION['status']="Selectionnez les donnés à modifier";
            $_SESSION['status_code']="warning";    
        }
    }

    if(isset($_POST['supprimercarburant'])){
        supprimercarburant();
    }
    
    function supprimercarburant(){
        global $mysqli;
        $num = mysqli_real_escape_string($mysqli, trim($_POST['numCrb']));
        $design = mysqli_real_escape_string($mysqli, trim($_POST['designCrb']));
        $pu = $_POST['puCrb'];
        $stock = $_POST['stockCrb'];

        if($design && $pu && $stock){
            $sql = "DELETE FROM carburant WHERE numcarburant = '$num' ";
            if(mysqli_query($mysqli, $sql)){
                $_SESSION['status']="Suppression avec success";
                $_SESSION['status_code']="success";    
            } else {
                $_SESSION['status']="Echec de suppression";
                $_SESSION['status_code']="error";    
            }
        } else {
            $_SESSION['status']="Indiquer le champs à supprimer";
            $_SESSION['status_code']="warning";    
        }
        
    }
?>