<?php
    require_once('connexion_bd.php');
    require_once('../les fonctions/fonctions.php');
    $erreur = "";
    $msg = "";
if(isset($_POST['submit'])){
    
    if(isset($_POST['email']))
        {
        //sororamon02@gmail.com
            $email = $_POST['email'];
        
          //$user = rechercher_par_email($email);
         $requete = $pdo->prepare("SELECT * FROM utilisateur WHERE email=?");
        $requete->execute(array($email));
        $resultat = $requete->fetchAll();
        //$resultat = $requete->rowCount();
       
        $user = $resultat;
        if($user) {
            
            $id = $user['idUtilisateur'];//si l'utlisateur existe on va récuperer son id

            //on va faire une requête pour changer le mot de passe de l'utilisateur
                $requete = $pdo->prepare("update utilisateur set pwd=MD5('0000') where idUtilisateur=$id");
                $requete->execute();

                //on va envoyer un message à l'adresse email de l'utilisateur pour lui dire que son mot de passe a été initialisé a 0000

                $adresse_user = $user['email'];//cette variable va récuperer l'adresse de l'utilisateur
                $objet = "Initialisation de mot de passe";//l'objet de l'eamail
                $message = "Votre nouveau mot de passe est 0000, veuillez le modifier à votre prochaine connexion";//le message envoyé à l'utilisateur

                $entete = "From : Application GESTION STAGIAIRE"."\r\n"."cc:sororamon03@gmail.com";//l'entête du message
                //sororamon03@gmail.com est l'email de la 'société'

                mail($adresse_user, $objet, $message, $entete);

                $erreur = "Non";

                $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";

            }else{

                $erreur = "Oui";
            
                $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
        }
       
        } 
    else
        { 
            $msg = "Veuillez saisir un email!!";
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
                        <button type="submit" class="btn btn-success" name="submit">
                            Initialiser le mot de passe
                        </button>
                    
                    </form>
               </div>
            
            </div>
            
             <div class="text-center">

                <?php

                if ($erreur == "oui") {

                    echo '<div class="alert alert-danger">' . $msg . '</div>';

                    header("refresh:3;url=initialiser_pwd.php");

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