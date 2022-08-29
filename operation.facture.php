<?php 
    require_once('connection.php');
    global $mysqli;

    
    if(isset($_POST['goSearch'])){
        getFacture();
    }

    function getFacture(){
        global $mysqli;
        $se = mysqli_real_escape_string($mysqli, trim($_POST['cod']));
        $sql = "SELECT c.design as DESIGN, c.pu as PU, a.qte as QUANTITE, pu*qte as MONTANT 
                FROM carburant c, achat a
                WHERE (c.numcarburant = a.numcarburant) AND (a.codecli = '$se');";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res;
        }
        else{
            $_SESSION['status']="Pas d'achat valide";
            $_SESSION['status_code']="error";  
        }
    }

    function listeClient(){
        global $mysqli;
        $sql="SELECT * FROM client;";
        $res=mysqli_query($mysqli, $sql);
        if($res){
            return $res;
        }
    }

    //Message
    function affiche_message($class, $msg){
        echo "<h4 class='$class text-center'>$msg</h4>";
    }

    //Get Data from Mysql
?>
        
