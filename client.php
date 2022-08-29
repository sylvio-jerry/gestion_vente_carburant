<?php require_once("operation.client2.php");
      require_once("manage.excel.php");
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
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <menu class="col-md-2">
                <img src="img/admin/Screenshot (71).png" alt="" class="img-circle"> <br>
                <ul class="">
                    <li> <a href="dashboard.php"> <i class="fas fa-home fa-lg"></i> Accueil </a> </li>
                    <li> <a href="#" id="client"> <i class="fas fa-user fa-lg"></i> Client </a> </li>
                    <li> <a href="carburant.php" id="carburant"> <i class="fas fa-fax fa-lg"></i> Carburant </a> </li>
                    <li> <a href="achat.php" id="achat"> <i class="fas fa-shipping-fast fa-lg"></i> Achat </a> </li>
                    <li> <a href="liste.achat.php" id="listeachat"> <i class="fas fa-list fa-lg"></i> Liste </a> </li>
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
                    <legend class="text-center">CLIENT</legend>
                    <div class="inputclient col-md-4">
                        <fieldset>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="codeclient"> code client: </label> 
                                    <input type="text" name="codeclient" id="codeclient" class="form-control" readonly="readonly" value='CLI-<?php setIdclient() ?>'> 
                                </div>
                                <div class="form-group ">
                                    <label for="nom"> Nom: </label> 
                                    <input type="text" name="nomclient" id="nomclient" class="form-control"> 
                                </div>
                                <div class="btn-group btn-group-md">
                                    <h5 class='text-center page-header'>Actions</h5>
                                    <button class="btn btn-default" name='ajouterclient' id='ajouterclient'>Ajouter</button>
                                    <button class="btn btn-default" name='modifierclient' id='modifierclient'>Modifier</button>
                                    <button class="btn btn-default" name='supprimerclient' id='supprimerclient' disabled>Supprimer Tout</button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                    <div class="col-md-8 tablec">
                        <div class="btn">
                            <form action="" method="post">
                                <strong>Exporter en: </strong>
                                <button type="submit" id="exportClientExcel" name='exportClientExcel'
                                    value="Excel" class="btn btn-default">
                                    <i class="fas fa-file-excel text-success fa-lg">Excel</i>
                                </button>
                                <button type="submit" id="exportClientPdf" name='exportClientPdf'
                                    value="Pdf" class="btn btn-default">
                                    <i class="fas fa-file-pdf text-danger fa-lg">Pdf</i>
                                </button>
                            </form>
                        </div>
                        <table class="tableclient table-bordered" id="tableclient">
                            <thead>
                                <tr>
                                    <th>Code client</th>
                                    <th>Nom</th>
                                    <th class='text-center'>Editer</th>
                                    <th class='text-center'>Facture</th>
                                    <th class="text-center">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     $result = getData();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $codeclient=$row['codecli'];
                                            $nomclient=$row['nomcli'];
                                            ?>
                                                
                                                <tr>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['codecli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['nomcli']; ?> </td>
                                                    <td class='text-center'> 
                                                        <i class="fas fa-edit text-warning btnEditClient fa-lg" data-id="<?php echo $row['codecli']?>"></i>
                                                    </td>
                                                    <td class="text-center"><a href="facture.php?GET_ID_CLI=<?php echo $codeclient ?>"><i class="fas fa-book text-info btnFactClient fa-lg" data-id="<?php echo $row['codecli']?>"></i></a></td>
                                                    <td class="text-center"><a href="deleteClient.php?SupCli=<?php echo $row['codecli']?>"><i class="fas fa-trash-alt text-danger btnSupClient fa-lg" data-id="<?php echo $row['codecli']?>"></i></a></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/index_client.js"></script>
<script type='text/javascript'>
    $('#tableclient').dataTable({});
</script>
</html>