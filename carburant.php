<?php 
    require_once('operation.carburant.php');
    require_once('manage.pdf.php');
    include('manage.excel.php'); 
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
    <!-- <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button{
            -webkit-appearance: none;
        } 
        //Manala an le spinbox
    </style> -->
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
                    <li> <a href="#" id="carburant"> <i class="fas fa-fax fa-lg"></i> Carburant </a> </li>
                    <li> <a href="achat.php" id="achat"> <i class="fas fa-shipping-fast fa-lg"></i> Achat </a> </li>
                    <li> <a href="liste.achat.php" id="listeachat"> <i class="fas fa-list fa-lg"></i> Liste </a> </li>
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
                    <fieldset class="">
                        <legend class="text-center">CARBURANTS</legend>
                        <form action="" method="post" class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="numCrb">N°Carburant: </label>    
                                    <input name="numCrb" id="numCrb" type="text" value="CRB-<?php numCarburant()?>" class="form-control" readonly>  
                                </div>
                                <div class="form-group">
                                    <label for="designCrb">Designation: </label>    
                                    <input name="designCrb" id="designCrb" type="text" class="form-control"> 
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="puCrb">Prix Unitaire: </label>    
                                    <input name="puCrb" id="puCrb" type="text" class="form-control" min="0">  
                                </div>
                                <div class="form-group">
                                    <label for="stockCrb">Stock: </label>    
                                    <input name="stockCrb" name="stockCrb" type="text" class="form-control" min="0">  
                                </div>
                            </div>
                            <div class="col-md-2 btn-group-vertical btn-group-md">
                                <h5 class="text-center">Actions</h5>
                                <button name="ajoutercarburant" id="ajoutercarburant" class="btn btn-default">Ajouter</button>
                                <button name="modifiercarburant" id="modifiercarburant" class="btn btn-default">Modifier</button>
                                <button name="supprimercarburant" id="supprimercarburant" class="btn btn-default" disabled>Supprimer Tout</button>
                            </div>
                        </form>
                    </fieldset>
                    <div class="btn"> 
                        <form action="" method="post">
                            <strong>Exporter en: </strong>
                            <button type="submit" id="exportCarburantExcel" name='exportCarburantExcel' value="Excel" class="btn btn-default">
                                <i class="fas fa-file-excel text-success fa-lg">Excel</i>
                            </button>
                            <button type="submit" id="exportCarburantPdf" name='exportCarburantPdf' value="Pdf" class="btn btn-default">
                                <i class="fas fa-file-pdf text-danger fa-lg">Pdf</i>
                            </button>
                        </form>
                    </div>
                    <fieldset>
                        <table id="tableCrb" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N° Carburant</th>
                                    <th>Designation</th>
                                    <th>Prix unitaire</th>
                                    <th>Stock</th>
                                    <th class="text-center">Editer</th>
                                    <th class="text-center">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = listedonne();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td data-id="<?php echo $row['numcarburant']?>"> <?php echo $row['numcarburant']; ?> </td>
                                                    <td data-id="<?php echo $row['numcarburant']?>"> <?php echo $row['design']; ?> </td>
                                                    <td data-id="<?php echo $row['numcarburant']?>"> <?php echo $row['pu']; ?> </td>
                                                    <td data-id="<?php echo $row['numcarburant']?>"> <?php echo $row['stock']; ?> </td>
                                                    <td class="text-center"> 
                                                        <i class="fas fa-edit text-warning btneditcarburant fa-lg" data-id="<?php echo $row['numcarburant']?>"></i>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="deleteCarburant.php?SupCrb=<?php echo $row['numcarburant']?>"><i class="fas fa-trash-alt text-danger fa-lg" data-id="<?php echo $row['numcarburant']?>"></i></a> 
                                                    </td>
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
<script src="js/index.js"></script>
<script>
    $('#tableCrb').dataTable({});
</script>

<!-- 
    * button doit être inclus dans la formulaire ainsi on ne doit pas indique son type
    * ou seulement on typ='submit'
 -->

</html>

