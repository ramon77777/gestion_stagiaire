<?php
    session_start();
    require_once('connexion_bd.php');
    
    
    $login = isset($_POST['login'])?$_POST['login']:"";
    $pwd = isset($_POST['pwd'])?$_POST['pwd']:"";

    //requête pour recupérer le login dans la base de données
    $requete = "select idUtilisateur, login, email, role, etat from utilisateur where login='$login' and pwd =md5('$pwd') ";
    $resultat = $pdo->query($requete);//query() est utilisé pour les requêtes de sélection
   
    if($user=$resultat->fetch()){//si l'utilisateur existe, on va véfier son état (activer ou désactiver)
        if($user['etat']==1){//1 correspond à activer, donc s'il est activé alors on va créer une session
            $_SESSION['user']=$user;// $_SESSION['user'] cette variable de session permet de récuperer les informations qu'un utilisateur utilise pour se connecter
            header('location:../index.php');//si l'utilisateur est activé on le rédige vers la page index
            
        }else{//sinon pour un compte qui existe et désactiver, on va gérer un message et le retourner vers la page login
            $_SESSION['erreur_login']="<strong>Erreur!!</strong> Votre compte est désactivé.<br>Veuillez contacter l'administrateur pour l'activer";
            header('location:login.php');
        }
        
        
    }else{
         $_SESSION['erreur_login']="<strong>Erreur!!</strong> Login ou mot de passe incorrecte!!!";
         header('location:login.php');
    }



?>
