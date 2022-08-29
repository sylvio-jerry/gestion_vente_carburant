<?php 
    include('operation.paiement.php');
    include('getAnnee.php'); 
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
                    <li> <a href="#"> <i class="fas fa-home fa-lg"></i> Accueil </a> </li>
                    <li> <a href="client.php" id="client"> <i class="fas fa-user fa-lg"></i> Client </a> </li>
                    <li> <a href="carburant.php" id="carburant"> <i class="fas fa-fax fa-lg"></i> Carburant </a> </li>
                    <li> <a href="achat.php" id="achat"> <i class="fas fa-shipping-fast fa-lg"></i> Achat </a> </li>
                    <li> <a href="liste.achat.php" id="listeachat"> <i class="fas fa-list fa-lg"></i> Liste </a> </li>
                    <!-- <li> <a href="facture.php" id="facture"> <i class="fas fa-file-invoice-dollar fa-lg"></i> Facture </a> </li> -->
                    <li> <a href="#" id="paiement"> <i class="fas fa-file fa-lg"></i> Paiement </a> </li>
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
                    <div id="myModal" class="" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="text-center" style="text-decoration: underline;">Montant total des carburants <br> payés par espèce et carte</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="" class="form-inline" method="post">
                                        <label for="">Annee</label>
                                        <select name="dateAn" id="dateAn" class="form-control">
                                            <option value="Tout" selected>Tout</option>
                                            <?php 
                                                $res =  listeDate();
                                                if($res){
                                                    while($row = mysqli_fetch_assoc($res)){
                                                        ?>
                                                            <option value="<?php echo $row['dateA']?>"> <?php echo $row['dateA'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                        </select>
                                    </form>
                                    <br><br>
                                    <table id="tableMod" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mode de paiement</th>
                                                <th>Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $req =  listePaiement();
                                                if($req){
                                                    while($row = mysqli_fetch_assoc($req)){
                                                        ?>
                                                            <tr>
                                                                <td data-id="<?php echo $row['modepaie']?>"><?php echo $row['modepaie']; ?> </td>
                                                                <td data-id="<?php echo $row['nb']?>"><?php echo $row['nb']; ?> </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.js"></script>
<!-- <script>
    $('#tableMod').dataTable({});
</script> -->
</html>