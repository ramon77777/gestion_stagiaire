<?php
    session_start();
    
    if(isset($_SESSION['user'])){//si l'utilisateur est connecté il peut fait cette action; c'est à cause des pirates qui peuvent passer vers l'url pour effectuer certaines actions sur l'appli
        
        require_once('connexion_bd.php');

        //variable de recupération de l'id de l'utilisateur
        $idu = isset($_GET['idU'])?$_GET['idU']:0;//voir la page utilisateurs.php où se trouve le lien de supprimer_utilisateur.php pour comprendre le choix de la methode get()

        //suppression de l'id de l'utilisateur dans la base de données
        $requete = "delete from utilisateur  where idUtilisateur=?";
        $params = array( $idu);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        //une fois la suppression terminée, on se retourne vers la page des utilisateurs
        header('location:utilisateurs.php');
        
    
    }else{//sinon on le rédirige vers la page de connection
          header('location:login.php');
    }
   

?>