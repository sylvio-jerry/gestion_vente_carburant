<?php 
    include('operation.achat.php');
    include('sweet.message.php');
    function listeVenteAn(){
        global $mysqli;
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        
            $sql = "SELECT DISTINCT cli.*, dateachat FROM client cli, achat achat 
                    WHERE (cli.codecli = achat.codecli) AND year(dateachat) = $id
                    ORDER BY dateachat;";
            $res = mysqli_query($mysqli, $sql);
            if($res){
                echo "<h3>Année: $id</h3>";
                return $res;
            } else {
                echo "Erreur...";
            }
        } 
    }

    function listeVenteM(){
        global $mysqli;
        if(isset($_GET['idM'])){
            $id = $_GET['idM'];
        
            $sql = "SELECT DISTINCT cli.*, dateachat FROM client cli, achat achat 
                    WHERE (cli.codecli = achat.codecli) AND month(dateachat) = $id
                    ORDER BY dateachat;";
            $res = mysqli_query($mysqli, $sql);
            if($res){
                echo "<h3>Mois:".date("F", mktime(0, 0, 0, $id, 10))."</h3>";
                return $res;
            } else {
                echo "Erreur...";
            }
        } 
    }

    function listeVente2D(){
        global $mysqli;
        if(isset($_GET['idD1'])){
            $id1 = $_GET['idD1'];
            $id2 = $_GET['idD2'];
        
            $sql = "SELECT DISTINCT cli.*, dateachat FROM client cli, achat achat 
                    WHERE (cli.codecli = achat.codecli) AND (dateachat BETWEEN '$id1' AND '$id2')
                    ORDER BY dateachat;";
            $res = mysqli_query($mysqli, $sql);
            if($res){
                echo "<h3>Date de: $id1 à $id2</h3>";
                return $res;
            } else {
                echo "Erreur...";
            }
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
                    <li> <a href="#" id="listeachat"> <i class="fas fa-list fa-lg"></i> Liste </a> </li>
                    <!-- <li> <a href="facture.php" id="facture"> <i class="fas fa-file-invoice-dollar fa-lg"></i> Facture </a> </li> -->
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
                <div class="row dash-content2">
                    <legend class="text-center">LISTE DES CLIENTS</legend>
                    <div class="row">
                    <div class="col-md-6">
                        <a href="liste.achat.php" class="text-right"> <i class="fas fa-list fa-lg"></i> Liste des Achats </a>
                        <br><br>
                    </div>
                    </div>
                    <fieldset class="row">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°Client</th>
                                    <th>Nom</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="tabAnnee">
                                <?php 
                                    $result = listeVenteAn();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>   
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['codecli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['nomcli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['dateachat']; ?> </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                            <tbody id="tabMois">
                                <?php 
                                    $result = listeVenteM();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>   
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['codecli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['nomcli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['dateachat']; ?> </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                            <tbody id="tab2Annee">
                                <?php 
                                    $result = listeVente2D();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>   
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['codecli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['nomcli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['dateachat']; ?> </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/liste.cli.js"></script>
<script>
    $('#tableCrb').dataTable({});
</script>
</html>