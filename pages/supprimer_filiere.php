<?php
    session_start();
    
    if(isset($_SESSION['user'])){//si l'utilisateur est connecté il peut fait cette action; c'est à cause des pirates qui peuvent passer vers l'url pour effectuer certaines actions sur l'appli
        
        require_once('connexion_bd.php');

        //variable de recupération de l'id de la filière
        $idf = isset($_GET['idF'])?$_GET['idF']:0;//voir la page filieres.php où se trouve le lien de supprimer_filiere.php pour comprendre le choix de la methode get()

        $requetestag = "select count(*) countstag from stagiaire where idFiliere = $idf";
        $resultastag = $pdo->query($requetestag);
        $table_count_stag =  $resultastag->fetch();
        $nombre_stag = $table_count_stag['countstag'];


        if($nombre_stag==0){
        //suppression de l'id de la filière dans la base de données
        $requete = "delete from filiere  where idFiliere=?";
        $params = array( $idf);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        //une fois la suppression terminée, on se retourne vers la page des filières
        header('location:filieres.php');

        }else{

            $message = "Suppression impossible : vous devez d'abord supprimer tous les stagiaires inscris dans cette filière !";

            header("location:alerte.php?message=$message");
        }

    
    }else{//sinon on le rédirige vers la page de connection
          header('location:login.php');
    }
    

?>