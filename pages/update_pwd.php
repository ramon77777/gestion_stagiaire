<?php
    require_once('identification.php');

    require_once('connexion_bd.php');

    //récupération de l'id de l'utilisateur
    $iduser = $_SESSION['user']['idUtilisateur'];
    
    //récupération de l'ancien mot de passe
    $oldpwd = isset($_POST['oldpwd'])?$_POST['oldpwd']:"";//ceci veut dire, si le mot de passe existe on le recupère sinon on récupère une chaîne vide

    //récupération du nouveau mot de passe
    $newpwd = isset($_POST['newpwd'])?$_POST['newpwd']:"";

    $requete = "select * from utilisateur where idUtilisateur=$iduser and pwd=MD5('$oldpwd')";
    $resultat = $pdo->prepare($requete);
    $resultat->execute(); 

    $message = "";
    
    $interval = 3 ;//le temps d'affichage du message($message)
    $url = "login.php";//la rédirection

    if($resultat->fetch()){//si l'utilisateur existe voilà ce qui va se passer(s'il saisit un mot de passe correcte)
        
        $requete = "update utilisateur set pwd = MD5(?) where idUtilisateur=?";
        $params = array($newpwd, $iduser);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        
        $message = "<div class='alert alert-success'>
                        <strong>Félicitation</strong> Votre mot de passe a été modifié avec succès
                    </div>" ;
                    
        
    }else{//sinon si l'utilisateur n'existe pas(si son mot de passe n'est pas correcte)
        
        $message = "<div class='alert alert-danger'>
                        <strong>Erreur!</strong> L'ancien mot de passe est incorrecte!!!!
                    </div>" ;    
        
        $url = $_SERVER['HTTP_REFERER'];
        
       // header("refresh:3; url=".$_SERVER['HTTP_REFERER']);//cela permet d'afficher le message($message) pendant 3 sécondes et ensuite rédiriger l'utilisateur vers la page précendante(editer_pwd.php) pour réssaisir son ancien mot de passe
    }
    
     
    


?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Changement de mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
    
        <div class="container">
            
            <br><br>
            
            <?php
                echo $message ;
        
            header("refresh:$interval; url=$url");//cela permet d'afficher le message($message) pendant un certain temps ($interval) et ensuite rédiriger l'utilisateur vers la page de l'url
            
            ?>
            
        </div>
    
    </body>
</html>



