<?php 
    include("ajouter.admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Gestion des ventes des carburants</title>
</head>
<body>
    <div class="container">
        <header class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 section">
                <h2 class="text-center jumbotron">GESTION DE VENTE DES CARBURANT</h2>
                <div class="link">
                    <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#login"> <i class="fas fa-sign-in-alt"></i> Se connecter</button>
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#inscrire"> <i class="fas fa-user-edit"></i> S'inscrire </button>
                </div>
                <!------------------ Modal Login ------------------>
                <div class="modal fade" id="login" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center"> <i class="fas fa-sign-in-alt"></i> Admin </h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="pseudo"> <i class="fas fa-user"></i> Pseudo: </label> 
                                        <input type="text" name="pseudo" id="pseudo" class="form-control" required> 
                                    </div>
                                    <div class="form-group">
                                        <label for="mot2pass"> <i class="fas fa-key"></i> Mot de passe: </label> 
                                        <input type="password" name="mot2pass" id="mot2pass" class="form-control" required> 
                                    </div>
                                    <h4 class="text-center">Je ne suis pas encore un membre admin? <br> 
                                        <a href="#inscrire" data-toggle="modal" class="text-success">Je m'inscris</a> <br>
                                        <a href="" class="text-danger"> Mot de passe oublié? </a>
                                    </h4>
                                    <div class="form-group modal-footer">
                                        <label class="sr-only" for="">authentifier</label>  
                                        <input type="submit" name="authentifier" id="authentifier" value="Authentifier" class="btn btn-info btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------ Modal S'inscrire ------------------>
                <div class="modal fade" id="inscrire" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title text-center"> 
                                    <i class="fas fa-edit"></i> 
                                    Je ne suis pas encore un admin <br>
                                    Je m'inscris 
                                </h3>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="prenom"> Prénom: </label> 
                                        <input type="text" name="prenom" id="prenom" class="form-control"> 
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="nom"> Nom: </label> 
                                        <input type="text" name="nom" id="nom" class="form-control"> 
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="email"> E-mail: <span class="text-danger">*</span> </label> 
                                        <input type="email" name="email" id="email" class="form-control" required> 
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="username"> Nom utilisateur: <span class="text-danger">*</span></label> 
                                        <input type="text" name="username" id="username" class="form-control" required> 
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="passwd"> Mot de passe: <span class="text-danger">*</span> </label> 
                                        <input type="password" name="passwd" id="passwd" class="form-control" required> 
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="confirm"> Confirmé: <span class="text-danger">*</span> </label> 
                                        <input type="password" name="confirm" id="confirm" class="form-control" required> 
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label for="profile">Choisir votre profile <i class="fas fa-portrait"></i> :<span class="text-danger">*</span> </label> 
                                        <input type="file" name="profile" id="profile" accept="*" class="form-control" required> 
                                    </div>
                                    <i><span class="text-danger">*</span> Champs obligatoire</i>
                                    <div class="form-group">
                                        <label class="sr-only" for="inscrire">Inscrire</label>  
                                        <input type="submit" name="inscrire" id="inscrire" value="Je m'inscris" class="text-center btn btn-info btn-lg">
                                    </div>
                                </form>
                                <h4 class="text-center">En vous inscrivant, vous acceptez les <span class="text-success">conditions <br> générales d'utilisations</span> </h4>
                            </div>
                            <div class="modal-footer">
                                <h4>J'ai déjà un compte  <button type="button" class="btn btn-danger" data-dismiss="modal"> Fermé </button> </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-2"></div>
        </header>    
    </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/index.js"></script>
</html>

<!-- 
    Noté bien:
    * on ne peut pas utiliser <section></section> pour le modal    
    * .sr-only: cacher
    * enctype="multipart/form-data": pour envoyer des données en format binaire
-->