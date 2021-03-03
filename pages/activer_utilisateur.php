<?php
    session_start();
    require_once('connexion_bd.php');
    
    if(isset($_SESSION['user'])){//si l'utilisateur est connecté il peut fait cette action; c'est à cause des pirates qui peuvent passer vers l'url pour effectuer certaines actions sur l'appli

        //variables de recupération des infos de l'utilisateur
        $idu = isset($_GET['idU'])?$_GET['idU']:0;//voir la page utilisateurs.php où se trouve le lien de activer_utilisateur.php pour comprendre le choix de la methode get()
        $etat = isset($_GET['etat'])?$_GET['etat']:0;

        if($etat==1)//si l'état initial est 1 alors le nouveau état prend 0
            $new_etat = 0 ;
        else
            $new_etat = 1 ;//sinon le nouveau état prend 1 si l'état initial est 0

        $requete = "update utilisateur set etat=? where idUtilisateur=?";
        $params = array( $new_etat, $idu);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        //une fois la mise à, jour terminée, on se retourne vers la page des utilisateurs
        header('location:utilisateurs.php');
    
    
    }else{//sinon on le rédirige vers la page de connection
          header('location:login.php');
    }
   
?>