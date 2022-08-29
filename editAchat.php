<?php 
    include('operation.edit.php');
    include('sweet.message.php');
?>

<?php 
     global $mysqli;

     if(isset($_GET['editCodecli'])){
        $editCodecli = $_GET['editCodecli'];
        $editCrb = $_GET['editCrb'];
        $req = "SELECT * FROM achat WHERE codecli = '$editCodecli' AND numcarburant = '$editCrb'";
        $res = mysqli_query($mysqli, $req);

        while($row = mysqli_fetch_assoc($res)){
            $codecli = $row['codecli'];
            $numCrb = $row['numcarburant'];
            $qte = $row['qte'];
            $date = $row['dateachat'];
            $paie = $row['modepaie'];
        }   

        $req = "SELECT * FROM achat WHERE codecli = '$editCodecli';";
        $res = mysqli_query($mysqli, $req);
        while($row = mysqli_fetch_assoc($res)){
            $codecli1 = $row['codecli'];
            $numCrb1 = $row['numcarburant'];
            $qte1 = $row['qte'];
            $date1 = $row['dateachat'];
            $paie1 = $row['modepaie'];
        }
     }

     

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <title>Tableau de bord</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <menu class="col-md-2">
                <img src="img/admin/Screenshot (71).png" alt="" class="img-circle"> <br>
                <ul class="">
                    <li> <a href="dashboard.php"> <i class="fas fa-home fa-lg"></i> Accueil </a> </li>
                    <li> <a href="client.php" id="client"> <i class="fas fa-user fa-lg"></i> Client </a> </li>
                    <li> <a href="carburant.php" id="carburant"> <i class="fas fa-fax fa-lg"></i> Carburant </a> </li>
                    <li> <a href="achat.php" id="achat"> <i class="fas fa-shipping-fast fa-lg"></i> Achat </a> </li>
                    <li> <a href="liste.achat.php" id="listeachat"> <i class="fas fa-list fa-lg"></i> Liste </a> </li>
                    <li> <a href="facture.php" id="facture"> <i class="fas fa-file-invoice-dollar fa-lg"></i> Facture </a> </li>
                    <li> <a href="paiement.php" id="paiement"> <i class="fas fa-file fa-lg"></i> Paiement </a> </li>
                    <li> <a href="profile.php" id="profile"> <i class="fas fa-user-edit fa-lg"></i> Profile </a> </li>
                </ul>
            </menu>
            <div class="col-md-10 dash-content">
                <div class="row dash-content1">
                    <!-- <p>dash-content1</p> -->
                    <h3 class="" id="logo">GESTION DE VENTE DES CARBURANT</h3>
                    <article class="link">
                        <a href="" class="btn btn-success" id="deconnecter">Deconnecter</a>
                    </article>
                </div>
                <div class="row dash-content2 editAchat">
                    <fieldset class="" id="formAchat">
                        <legend class="text-center">EDIT ACHAT</legend>
                        <form action="#?IDCli=<?php echo  $codecli1; ?>&IDCrb=<?php echo $numCrb1; ?>" method="post" class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="editnumcliAchat">N°Client: </label>    
                                    <input value="<?php echo  $codecli; ?>" name="editnumcliAchat" id="editnumcliAchat" type="text" class="form-control" readonly>  
                                </div>
                                <div class="form-group">
                                    <label for="editnumCrbAchat">N°Carburant: </label>    
                                    <input value="<?php echo   $numCrb; ?>" name="editnumCrbAchat" id="editnumCrbAchat" type="text" class="form-control" readonly> 
                                </div>
                                <div class="form-group">
                                    <label for="editmodepaie">Mode de paiement: </label>   
                                    <input placeholder="par_carte ou en_espece" value="<?php echo  $paie; ?>" name="editmodepaie" id="editmodepaie" type="text" class="form-control">  
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="editqteAchat">Quantité: </label>    
                                    <input value="<?php echo   $qte; ?>" name="editqteAchat" id="editqteAchat" type="text" class="form-control" min="0">  
                                </div>
                                <div class="form-group">
                                    <label for="editdateAchat">Date Achat: </label>    
                                    <input placeholder="yyyy-mm-dd" value="<?php echo  $date; ?>" name="editdateAchat" id="editdateAchat" type="text" class="form-control">  
                                </div>
                                <div class="btn-group btn-group-md text-center"> 
                                    <h4>Actions</h4>
                                    <button name="editAs" id="editAs"  class="btn btn-info">Modifier</button>
                                    <a href="achat.php" name="suppA" id="suppA"  class="btn btn-default">Annuler</a>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script>
    $('#tableCrb').dataTable({});
</script>
</html>





