<?php
    require_once('identification.php');
    require_once('connexion_bd.php');
   

    //variable pour recupérer l'id de l'utilisateur
    $id = isset($_GET['id'])?$_GET['id']:0;//voir la page menu.php où se trouve le lien de editer_user.php pour comprendre le choix de la methode get()

    //requête pour recupérer toutes les informations rélatives à l'utilisateur dont l'id est égal à  idUtilisateur dans la base de données 
    $requete = "select * from utilisateur where  idUtilisateur=$id";
    $resultat = $pdo->query($requete);//query() est utilisé pour les requêtes de sélection
    
    //variable de recuperation deu resultat de la requête dans un tableau associatif
    $utilisateur = $resultat->fetch();
    
    //recupération du login et de l'email  de l'utilisateur
    $login = $utilisateur['login'];
    $email = $utilisateur['email'] ;
    
    

    
   
    
    
?>



<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <!--pour apprendre bootstrap : voir w3schools -->
        <!--une div permet de diviser une page en plusieurs morceaux -->
         <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite       et de centrer le contenu -->
            
         <!--nouveau panneau -->
            <div class="panel panel-primary margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Edition de l'utilisateur </div>
                <div class="panel-body">
                    
                     <form method="post" action="update_utilisateur.php" class="form" >
                    <!-- enctype="multipart/form-data" permet d'envoyer fichiers comme des images, document pdf...; tous ce qui est du binaire-->
                         
                          <!-- recupération de l'id de l'utilisateur-->
                        <div class="form-group">
                          <!--  <label for="id">Id de l'utilisateur:</label>  -->
                            <input type="hidden" name="iduser" class="form-control" value="<?php echo "$id" ?> "> 
                        </div>
                         
                          <!-- recupération du login de l'utilisateur-->
                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" name="login" class="form-control" autocomplete = "off" 
                                placeholder="<?php echo $login ?> " >
                        </div>
                         
                          <!-- recupération de l'email de l'utilisateur-->
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="text" name="email" class="form-control" autocomplete="off" 
                                placeholder="<?php echo $email ?> " >
                        </div>
                         
                      
                         
                        <button type="submit" name="envoyer" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span> Enrégistrer
                        </button>
                         
                         <a href="editer_pwd.php">Changer le mot de passe</a>
                        
                    </form>

                  
                    
                </div> 
            </div>
            
        </div>
    
    
    </body>
</html> 