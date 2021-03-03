<?php
    require_once('identification.php');
    require_once('connexion_bd.php');

    //requête pour recupérer les filières dans la base de données
    $requetef = "select * from filiere";
    $resultatf = $pdo->query($requetef);//query() est utilisé pour les requêtes de sélection
    
?>



<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouveau stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <!--pour apprendre bootstrap : voir w3schools -->
        <!--une div permet de diviser une page en plusieurs morceaux -->
         <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite       et de centrer le contenu -->
            
         <!--nouveau panneau -->
            <div class="panel panel-primary margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Les informations du nouveau stagiaire </div>
                <div class="panel-body">
                    
                     <form method="post" action="insert_stagiaire.php" class="form" enctype="multipart/form-data">
                    <!-- enctype="multipart/form-data" permet d'envoyer fichiers comme des images, document pdf...; tous ce qui est du binaire-->
                         
                          <!-- recupération du nom du stagiaire-->
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" class="form-control" placeholder="nom" autocomplete="off">
                        </div>
                         
                          <!-- recupération du prenom du stagiaire-->
                        <div class="form-group">
                            <label for="prenom">Prenom :</label>
                            <input type="text" name="prenom" class="form-control" placeholder="prenom" autocomplete="off">
                        </div>
                         
                          <!-- recupération de la civilité du stagiaire-->
                        <div class="form-group">
                            <label for="civilite">Civilité :</label>
                           <div class="radio">
                             <label> <input type="radio" name="civilite" value="F" checked> F 
                             </label><br>
                             <label> <input type="radio" name="civilite" value="M"  > M 
                             </label>
                             </div>
                           
                        </div>
                         
                          <!-- recupération de la filière du stagiaire-->
                        <div class="form-group">
                            <label for="idFiliere">Filière:</label>
                            <select name="idFiliere" id="idFiliere" class="form-control" ><!--onchange="this.form.submit()" joue le rôle de la touche enter sur le clavier-->                       
                                <?php while($filiere= $resultatf->fetch()){ ?>
                                    
                                    <option value=" <?php echo $filiere['idFiliere'] ?>" >
                                        <?php echo $filiere['nomFiliere'] ?>
                                    </option>
                                
                                <?php } ?>
                             </select>
                         </div>
                         
                          <!-- recupération de la photo du stagiaire-->
                         <div class="form-group">
                            <label for="photo">Photo :</label>
                            <input type="file" name="photo"  >
                              <!-- le type="file" permet d'avoir un boutton de parcourir les fichiers sur notre pc afin de choisir le fichier qu'on veut importer-->
                        </div>
                         
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span> Enrégistrer
                        </button>
                        
                    </form>
                    
                </div> 
            </div>
            
        </div>
    
    
    </body>
</html> 