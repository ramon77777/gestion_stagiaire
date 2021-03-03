<?php
    require_once('identification.php');
?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filière</title>
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
                <div class="panel-heading">Veuillez saisir les donnnées de la nouvelle filière </div>
                <div class="panel-body">
                    
                     <form method="post" action="insert_filiere.php" class="form">
                         
                        <div class="form-group">
                            <label for="nom">Nom de la filière:</label>
                            <input type="text" name="nomF" placeholder="Tapez le nom de la filière" class="form-control" >
                        </div>
                         
                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
                            <select name="niveau" id="niveau" class="form-control" ><!--onchange="this.form.submit()" joue le rôle de la touche enter sur le clavier-->                       
                                <option value="B" selected>Baccalaureat</option>
                                <option value="BT" >Brevet technique</option>
                                <option value="L1" >Licence1</option>
                                <option value="L2" >Licence2</option>
                                <option value="M1" >Master1</option> 
                                <option value="M2" >Master2</option>
                             </select>
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