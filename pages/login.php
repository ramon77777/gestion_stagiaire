<?php
    session_start();
    if(isset($_SESSION['erreur_login']))//si ya une erreur on la recupère avec la variable ci-desssous
        $erreur_login = $_SESSION['erreur_login'] ;
    else{//sinon la variable recupère rien
        $erreur_login = "";
    }

    session_destroy();/*cette fonction permet de réfermer la seesion de l'utilisatur precédent, en d'autre terme si l'utilisateur elle permet d'effacer le travil de l'utilisateur precédent */

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Se connecter</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
    
        <!--pour apprendre bootstrap : voir w3schools -->
        
        <!--une div permet de diviser une page en plusieurs morceaux -->
         <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-6"><!--
        *container permet d'appliquer une marge gauche et une marge droite et de centrer le contenu 
        *col-lg-offset-4 veut dire pour un écran large on saut 4 colonnes-->
            
         
            <div class="panel panel-primary margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Se connecter </div>
                <div class="panel-body">
                    
                     <form method="post" action="seconnecter.php" class="form" >
                         
                         <?php if(!empty($erreur_login)) { ?>
                             <div class="alert alert-danger">
                                <?php echo $erreur_login ; ?>
                             </div>
                         <?php } //ceci veut dire si $erreur_login est non vide c-à-d qu'il y a une erreur, alors on affiche la fiche et ce qu'elle contient, sinon elle ne s'affiche pas ?>
                         
                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" name="login" class="form-control" placeholder="login" autocomplete="off">
                        </div>
                         
                         
                        <div class="form-group">
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" name="pwd" class="form-control" placeholder="Mot de passe" >
                        </div>
        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-log-in"></span> Se connecter
                            </button> 
                        </div>

                        <div class="form-group">
                             
                             <a href="initialiser.php">Mot de passe oublié ?</a>
                             &nbsp;
                             <a href="nouvel_utilisateur.php">Créer un compte</a>
                        </div>
                         
                    </form>
                  
                        
                    
                </div> 
            </div>
            
        </div>
    
    
    </body>
</html> 