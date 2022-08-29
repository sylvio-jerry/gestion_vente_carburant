<?php 
    include('operation.achat.php');
    include('manage.excel.php');
    require_once("manage.pdf.php");
    include('sweet.message.php');
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
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance: none;
        } 
        /* //Manala an le spinbox */
    </style>
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
                    <li> <a href="#" id="profile"> <i class="fas fa-user-edit fa-lg"></i> Profile </a> </li>
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
                    <legend class="text-center">LISTE DES ACHATS </legend>
                    <a href="#" class="text-right"> <i class="fas fa-list fa-lg"></i> Liste des Client </a>
                    <div class="row">
                        <div class="col-md-6">
                            <select name="" id="choix" class="form-control">
                                <option value="recherche" selected> Recherche...</option>
                                <option value="parmois">Par mois</option>
                                <option value="parannee">Par année </i></option>
                                <option value="entre2date">Entre deux dates </i></option>
                            </select>
                            <br>
                            <form method = "post" class="form-inline" role="form" id="entre2date">
                                <div class="form-group">
                                    <label for="date1"> Du </label> 
                                    <input type="date" name = "date1" class="form-control" id="date1">
                                </div>
                                <div class="form-group">
                                    <label for="date2"> à </label>
                                    <input type="date" name = "date2" class="form-control" id="date2">
                                </div>
                                <a id="lien2D" type="submit" class="btn btn-default"> <i class="fas fa-search"></i> </a>
                            </form>
                            <form action="" method="post" id="annee" class="form-inline">
                                <div class="form-group">
                                    <label for="ans" class="sr-only"></label> 
                                    <input placeholder="Année ex: 2021" name="answ" id="ans" type="number" class="form-control" >
                                </div>
                                <a id="lienAnne" type="submit" class="btn btn-default"> <i class="fas fa-search"></i> </a>
                            </form>
                            <form action="" method="post" id="mois" class="form-inline">
                                <div class="form-group">
                                    <label for="ans" class="sr-only"></label> 
                                    <input placeholder="Mois entre 01-12 ex:03" name="answ" id="ansM" type="number" class="form-control" >
                                </div>
                                <a id="lienMois" type="submit" class="btn btn-default"> <i class="fas fa-search"></i> </a>
                            </form>
                        </div>
                    </div>
                    <fieldset>
                        <div class="btn">
                            <form action="" method="post">
                                <strong>Exporter en: </strong>
                                <button type="submit" id="exportAchatExcel" name='exportAchatExcel' value="Excel" class="btn btn-default">
                                    <i class="fas fa-file-excel text-success fa-lg">Excel</i>
                                </button>
                                <button type="submit" id="exportAchatPdf" name='exportAchatPdf' value="Pdf" class="btn btn-default">
                                    <i class="fas fa-file-pdf text-danger fa-lg">Pdf</i>
                                </button>
                            </form>
                        </div>
                        <table id="tableCrb" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Carburant</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = listeAchatCarburant();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['design']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['nomcli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['dateachat']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['pu']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['qte']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['montant']; ?> </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php 
                                    $result = Montant();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td>TOTAL</td>
                                                    <td> <?php echo $row['total']; ?> </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tfoot>
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