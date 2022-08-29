<?php 
    include('operation.facture2.php');
    require_once("manage.excel.php");
    require_once("manage.pdf.php");
    include('sweet.message.php');
    
    $getClient=listeClientFact();
    while($row=mysqli_fetch_assoc($getClient)){
        $codecliFact=$row['codecli'];
        $nomcliFact=$row['nomcli'];
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
                    <li> <a href="paiment.php" id="paiement"> <i class="fas fa-file fa-lg"></i> Paiement </a> </li>
                    <li> <a href="#" id="profile"> <i class="fas fa-user-edit fa-lg"></i> Profile </a> </li>
                </ul>
            </menu>
            <div class="col-md-10 dash-content">
                <div class="row dash-content1">
                    <!-- <p>dash-content1</p> -->
                    <h3 class="" id="logo">GESTION DE VENTE DES CARBURANTS</h3>
                    <article class="link">
                        <a href="" class="btn btn-success" id="deconnecter">Deconnecter</a>
                    </article>
                </div>
                <div class="row dash-content2">
                
                    <fieldset class='row container-fluid' id="fieldFact">
                        <legend class='text-center'>FACTURE</legend>
                        <div class="col-md-2">
                            <i class='fas fa-swatchbook fa-lg'></i>
                            <i class='fas fa-swatchbook fa-lg'></i>
                        </div>
                        <div class="col-md-4">
                            <h3>Nom : <?php echo $nomcliFact ?></h3>
                            <h3>N° Client : <?php echo $codecliFact ?></h3>
                        </div>
                        <div class="col-md-6">
                            <p>N° Facture : <?php referFact() ?> </p>
                            <p>Date : <?php dateNow(); ?></p>
                            <p>Heure : <?php heureNow(); ?></p>
                        </div>
                    </fieldset>
                    <div class="btn">
                        <form action="" method="post">
                            <strong>Exporter en: </strong>
                            <button type="submit" id="exportFactureExcel" name='exportFactureExcel'
                                value="Excel" class="btn btn-default">
                                <i class="fas fa-file-excel text-success fa-lg">Excel</i>
                            </button>
                            <button type="submit" id="exportFacturePdf" name='exportFacturePdf'
                                value="Pdf" class="btn btn-default">
                                <i class="fas fa-file-pdf text-danger fa-lg">Pdf</i>
                            </button>
                        </form>
                    </div>
                    <div class="row tablef">
                        <table id="tablefacture" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>CARBURANT</th>
                                    <th>PU</th>
                                    <th>QUANTITE</th>
                                    <th>MONTANT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result=getFacture();
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td> <?php echo $row['DESIGN']; ?> </td>
                                                    <td> <?php echo $row['PU']; ?> </td>
                                                    <td> <?php echo $row['QUANTITE']; ?> </td>
                                                    <td> <?php echo $row['MONTANT']; ?> </td>
                                                </tr>
                                            <?php
                                        }
                                ?>
                            </tbody>
                            <tfoot>
                                    <tr>
                                        <?php 
                                            $result = showAmountFacture();
                                            if($result){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    ?>
                                                        <tr>
                                                            <td colspan='2'></td>
                                                            <td>TOTAL</td>
                                                            <td><?php echo $row['somme']; ?></td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <h4 class='text-center page-header' id="converssion">
                                <?php 
                                 $result = showAmountFacture();
                                 if($result){
                                     while($row = mysqli_fetch_assoc($result)){      
                                         $value=$row['somme'];
                                         $letter=int2str($value);
                                         $valueMaj=strtoupper($letter);
                                     }
                                     echo 'ARRETEE LA PRESENTE FACTURE A LA SOMME DE <br/>'.$valueMaj.' FMG';
                                }
                                ?>
                            </h4>
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
<script>
    $('#tablefacture').dataTable({});
</script>
</html>