<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/Chart.min.css">
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
                <div class="row dash-content2 bg">
                    <div class="jb">
                        <a href="client.php" id="client"><div class="col-md-4 text-center jumbotron"><i class="fas fa-user fa-lg"></i> CLIENT </div></a>
                        <a href="carburant.php" id="carburant"> <div class="col-md-4 text-center jumbotron"> <i class="fas fa-fax fa-lg"></i> CARBURANT </div></a>
                        <a href="achat.php" id="achat"> <div class="col-md-3 text-center jumbotron"> <i class="fas fa-shipping-fast fa-lg"></i> ACHAT </div></a> 
                        <a href="liste.achat.php" id="listeachat"><div class="col-md-4 text-center jumbotron"><i class="fas fa-list fa-lg"></i> LISTE </div></a>
                        <a href="paiement.php" id="paiement"><div class="col-md-4 text-center jumbotron"> <i class="fas fa-file fa-lg"></i> PAIEMENT</div></a> 
                        <a href="profile.php" id="profile"> <div class="col-md-3 text-center jumbotron"> <i class="fas fa-user-edit fa-lg"></i> PROFILE</div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Chart.min.js"></script>
</html>