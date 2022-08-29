<?php 
    include('operation.achat.php'); 
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
                    <li> <a href="client.php" id="client"> <i class="fas fa-user fa-lg"></i> Client </a> </li>
                    <li> <a href="carburant.php" id="carburant"> <i class="fas fa-fax fa-lg"></i> Carburant </a> </li>
                    <li> <a href="#" id="achat"> <i class="fas fa-shipping-fast fa-lg"></i> Achat </a> </li>
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
                    <fieldset class="" id="formAchat">
                        <legend class="text-center">ACHAT</legend>
                        <form action="" method="post" class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="numcliAchat">N°Client: </label>    
                                    <!-- <input name="numcliAchat" id="numcliAchat" type="text" class="form-control">   -->
                                    <select name="numcliAchat" id="numcliAchat" class="form-control">
                                        <?php
                                            $res =  listeCodeCli();
                                            if($res){
                                                while($row = mysqli_fetch_assoc($res)){
                                                    ?>
                                                        <option data-toggle="tooltip" title="<?php echo $row['nomcli'] ?>" value="<?php echo $row['codecli']?>"> <?php echo $row['codecli'] ?> </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="numCrbAchat">N°Carburant: </label>    
                                    <!-- <input name="numCrbAchat" id="numCrbAchat" type="text" class="form-control">  -->
                                    <select name="numCrbAchat" id="numCrbAchat" class="form-control">
                                        <?php 
                                            $res =  listeCodeCarburant();
                                            if($res){
                                                while($row = mysqli_fetch_assoc($res)){
                                                    ?>
                                                        <option data-toggle="tooltip" title="<?php echo $row['design'] ?>" value="<?php echo $row['numcarburant']?>"> <?php echo $row['numcarburant'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Quantité: </label>    
                                    <input name="qteAchat" id="qteAchat" type="number" class="form-control" min="0">  
                                </div>
                                <div class="form-group">
                                    <label for="">Date Achat: </label>    
                                    <input name="dateAchat" id="dateAchat" type="date" class="form-control">  
                                </div>
                                <div class="form-group">
                                    <label for="">Mode de paiement: </label>   
                                    <select name="modepaie" id="modepaie" class="form-control">
                                        <option value="en_espece">en espèce</option>
                                        <option value="par_carte">par carte</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2 btn-group-vertical btn-group-md">
                                <h5 class="text-center">Actions</h5>
                                <button name="ajouterAchat" id="ajouterAchat"  class="btn btn-info">Ajouter</button>
                                <button name="modifierAchat" id="modifierAchat"  class="btn btn-default" disabled>Modifier</button>
                                <button name="supprimerAchat" id="supprimerAchat"  class="btn btn-default" disabled>Supprimer Tout</button>
                            </div>
                        </form>
                    </fieldset>
                    <fieldset>
                        <table id="tableCrb" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°Client</th>
                                    <th>N°Carburant</th>
                                    <th>Quantité</th>
                                    <th>Date Achat</th>
                                    <th>Mode Paiement</th>
                                    <th class="text-center">Editer</th>
                                    <th class="text-center">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = listeDonneAchat();
                                    if($result){
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['codecli']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['numcarburant']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['qte']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['dateachat']; ?> </td>
                                                    <td data-id="<?php echo $row['codecli']?>"> <?php echo $row['modepaie']; ?> </td>
                                                    <td class="text-center"> 
                                                        <a href="editAchat.php?editCrb=<?php echo $row['numcarburant']?>&editCodecli=<?php echo $row['codecli']?>"><i class="fas fa-edit text-warning btneditAchat fa-lg" data-id="<?php echo $row['numcarburant']?>"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="deleteAchat.php?SupCodeCli=<?php echo $row['codecli']?>&SupCodeCrb=<?php echo $row['numcarburant']?>&SupQte=<?php echo $row['qte']?>"><i class="fas fa-trash-alt text-danger btnAchat fa-lg" data-id="<?php echo $row['numcarburant']?>"></i> </a>
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
<script>
    $('#tableCrb').dataTable({});
</script>
</html>