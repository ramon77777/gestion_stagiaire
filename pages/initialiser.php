<?php
    require_once('connexion_bd.php');
    require_once('../les fonctions/fonctions.php');
   

    $erreur = "";

    if (isset($_POST['email']))
         $email = $_POST['email'];
    else
         $email = "";
    
         
    $user = rechercher_par_email($email);
    
    if(isset($_POST['boutton']))
    {
        if ($user != null) {
        
            $id =$user['idUtilisateur'];
            $requete = $pdo->prepare("update utilisateur set pwd=MD5('0000') where  idUtilisateur=$id");
            $requete->execute();
        
            $to = $user['email'];
        
            $objet = "Initialisation de  votre mot de passe";
        
            $content = "Votre nouveau mot de passe est 0000, veuillez le modifier à la prochine ouverture de session";
        
            $entetes = "From: GesStag" . "\r\n" . "CC: sororamon01@gmail.com";
        
            mail($to, $objet, $content, $entetes);
        
            $erreur = "non";
        
            $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";
        
        } else {
            
            $erreur = "oui";
        
            $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
        
        }
    }

?>


<!DOCTYPE HTML>
<html>
    <head>
        <title>Initialisation du mot de passe</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
        <div class="container col-md-6 col-md-offset-3">
            <br>
            <div class="panel panel-primary">
                <div class="panel-heading">Initialiser votre mot de passe</div>
                
                <div class="panel-body">
                    <form class="form" method="post" action="#">
                        <div class="form-group">
                            <label class="control-label">
                                Veuillez saisir votre email de récupération
                            </label>
                            <input class="form-control" name="email" type="email" placeholder="Email" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-success" name="boutton">
                            Initialiser le mot de passe
                        </button>
                    
                    </form>
               </div>
            
            </div>
            
             <div class="text-center">

                <?php

                if ($erreur == "oui") {

                    echo '<div class="alert alert-danger">' . $msg . '</div>';

                  header("refresh:3;url=initialiser.php");

                    exit();
                } else if ($erreur == "non") {

                    echo '<div class="alert alert-success">' . $msg . '</div>';

                 header("refresh:3;url=login.php");

                    exit();
                }

                ?>

            </div>
       
        </div>
    </body>
</html>