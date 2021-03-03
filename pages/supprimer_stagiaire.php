<?php
    session_start();
    
        if(isset($_SESSION['user'])){//si l'utilisateur est connecté il peut fait cette action; c'est à cause des pirates qui peuvent passer vers l'url pour effectuer certaines actions sur l'appli
        require_once('connexion_bd.php');

        //variable de recupération de l'id du stagiaire
        $ids = isset($_GET['idS'])?$_GET['idS']:0;//voir la page stagiaires.php où se trouve le lien de supprimer_stagiaire.php pour comprendre le choix de la methode get()

        //suppression de l'id du stagiaire dans la base de données
        $requete = "delete from stagiaire  where idStagiaire=?";
        $params = array( $ids);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        //une fois la suppression terminée, on se retourne vers la page des stagiaires
        header('location:stagiaires.php');

    }else{//sinon on le rédirige vers la page de connection
          header('location:login.php');
    }

?>