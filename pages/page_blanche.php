<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page blanche</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <!--pour apprendre bootstrap : voir w3schools -->
        <!--une div permet de diviser une page en plusieurs morceaux -->
         <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite       et de centrer le contenu -->
            
            <div class="panel panel-success margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Rechercher des filières</div>
                <div class="panel-body">
                    le contenu du panneau
                </div> 
            </div>
            
            <!--nouveau panneau -->
            <div class="panel panel-primary "><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Liste des filières</div>
                <div class="panel-body">
                    le tableau des filères 
                </div> 
            </div>
            
        </div>
    
    
    </body>
</html> 