<?php
     require_once('identification.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Changement de mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/monjs.js"></script>
    </head>
    <body>
        <div class="container editpwd-page">
            <h1 class="text-center">Changement de mot de passe</h1>
            <h2 class="text-center">Compte : <?php echo $_SESSION['user']['login'] ?></h2>
            
            <form class="form-horizontal" method="post" action="update_pwd.php">
                
                <!--Debut de l'ancien mot de passe -->
                <div class="input-container">
                    <input class="form-control oldpwd" name="oldpwd" type="text" placeholder="Tapez votre ancien mot de passe" autocomplete="off" required>
                    
                    <i class="fa fa-eye fa-2x show-old-pass clickable"></i>
                </div>
                 <!--Fin de l'ancien mot de passe -->
                
                 <!--Debut du nouveau mot de passe -->
                 <div class="input-container">
                    <input class="form-control newpwd" name="newpwd" type="text" placeholder="Tapez votre nouveau mot de passe" autocomplete="off" minlength=4 required>
                        
                    <i class="fa fa-eye fa-2x show-new-pass clickable"></i>
                </div>
                
                 
                  <!--Fin du nouveau mot de passe -->
            
                <input type="submit" value="Enrégistrer" class="btn btn-primary btn-block">
            
            
            </form>
        </div>
    
   
            
    </body>
</html>