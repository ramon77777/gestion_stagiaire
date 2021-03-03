<?php
    require_once('identification.php');
    $message = isset($_GET['message'])?$_GET['message']:"Erreur";

?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Alerte</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <!--pour apprendre bootstrap : voir w3schools -->
        <!--une div permet de diviser une page en plusieurs morceaux -->
         <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite       et de centrer le contenu -->
            
            <div class="panel panel-danger margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading"><h4>Erreur:</h4></div>
                <div class="panel-body">
                   <h3> <?php echo $message ?> </h3>
                   <h4><a href="<?php echo $_SERVER['HTTP_REFERER'];//$_SERVER['HTTP_REFERER permet de retourner sur la page précedente  ?>">Retour>>> </a></h4>
                </div> 
            </div>
            
    
        </div>
    
    
    </body>
</html> 