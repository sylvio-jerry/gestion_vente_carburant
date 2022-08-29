<?php
    session_start(); 
    require_once("connection.php");
?>

<?php if($error):?>
    <div class="alert alert-danger"> <?= $error ?>  </div>
<?php endif ?>

<?php 
    
    $_SESSION['message'] = "";
    
    if(isset($_POST['inscrire'])){
        ajouterAdmin();
    }
    
    
    function ajouterAdmin(){
        global $mysqli;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if($_POST['passwd'] == $_POST['confirm']){

                $username = $mysqli -> real_escape_string($_POST['username']);
                $email = $mysqli -> real_escape_string($_POST['email']);
                $passwd = md5($_POST['passwd']);
                $profile = $mysqli -> real_escape_string('img/admin/'.$_FILES['profile']['name']);

                if(preg_match("!image!", $_FILES['profile']['type'])){

                    if(copy($_FILES['profile']['tmp_name'], $profile)){
                        $_SESSION['username'] = $username;
                        $_SESSION['passwd'] = $passwd;
                        $_SESSION['email'] = $email;
                        $_SESSION['profile'] = $profile;

                        $sql = "INSERT INTO admin(username, passwd, email,	profile) 
                                VALUES ('$username','$passwd','$email','$profile')";

                        if($mysqli->query($sql)){
                            $_SESSION['message'] = "$username a été ajouter comme un nouveau admin";
                        } else {
                            $_SESSION['message'] = "On ne peut pas ajouter cet admin";
                        }
                    } else {
                        $_SESSION['message'] = "Fail to upload file";
                    }
                } else {
                    $_SESSION['message'] = "Format de l'image invalide";
                }
            } else {
                $_SESSION['message'] = "Le mot de passe ne correspond pas";
                
            }
        }
    }
?>