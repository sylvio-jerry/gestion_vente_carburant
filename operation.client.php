<?php 
    require_once('connection.php');
    global $mysqli;

    if(isset($_POST['ajouterclient'])){
        ajouterClient();

    }

    if(isset($_POST['modifierclient'])){
        modifierclient();
    }

    function ajouterClient(){
        global $mysqli;
        $codecli= mysqli_real_escape_string($mysqli, trim($_POST['codeclient']));
        $nom= mysqli_real_escape_string($mysqli, trim($_POST['nomclient']));
        //Check if the fields are not empty and insert the values
        if($codecli && $nom){
            $sql = "INSERT INTO client(codecli, nomcli)
                    VALUES('$codecli', '$nom')";
            if(mysqli_query($mysqli, $sql)){
                $_SESSION['status']="ajout avec success";
                $_SESSION['status_code']="success";  
            } 
            else {
                $_SESSION['status']="Erreur d'ajout";
                $_SESSION['status_code']="error";  
            }
        } else {
            $_SESSION['status']="Vueiller remplir les champs vides";
            $_SESSION['status_code']="warning";  
        }
    }

    //Message
    function affiche_message($class, $msg){
        echo "<h4 class='$class text-center'>$msg</h4>";
    }

    //Get Data from Mysql
    function getData(){
        global $mysqli;
        $sql = "SELECT * FROM client";
        $result = mysqli_query($mysqli, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
    
    //Set id into the input of id field
    function setIdclient(){
        $getId = getData();
        $id = 0;
        if($getId){
            while($row = mysqli_fetch_assoc($getId)){
                $id++;
            }
        }
        echo $id+1;
    }

    //fonction modififier client
    function modifierclient(){
        global $mysqli;
        $codecli= mysqli_real_escape_string($mysqli, trim($_POST['codeclient']));
        $nom= mysqli_real_escape_string($mysqli, trim($_POST['nomclient']));
        if($codecli && $nom){
            $sql = "UPDATE client SET nomcli='$nom'
                    WHERE codecli= '$codecli' ";

            if(mysqli_query($mysqli, $sql)){
                $_SESSION['status']="Modification avec success";
                $_SESSION['status_code']="success";  
            } else {
                $_SESSION['status']="Erreur de modification";
                $_SESSION['status_code']="error";      
            }
        } else {
            $_SESSION['status']="Veuiller remplir les champs vide";
            $_SESSION['status_code']="error";  
        }
    }

    if(isset($_POST['supprimerclient'])){
        supprimerclient();
    }
    //fonction supprimer client
    function supprimerclient(){
        global $mysqli;
        $codecli= mysqli_real_escape_string($mysqli, trim($_POST['codeclient']));
        $nom= mysqli_real_escape_string($mysqli, trim($_POST['nomclient']));

        if($codecli && $nom){
            $sql = "DELETE FROM client WHERE codecli = '$codecli' ";
            if(mysqli_query($mysqli,$sql)){
                $_SESSION['status']="Suppression avec success";
                $_SESSION['status_code']="success";  
            } else {
                $_SESSION['status']="Echec de suppression";
                $_SESSION['status_code']="error";      
            }
        } else {
            $_SESSION['status']="Veuiller remplir les champs vides";
            $_SESSION['status_code']="warning";  
        }
    }

?>