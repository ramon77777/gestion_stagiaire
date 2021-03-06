<?php
    require_once('identification.php');
    require_once('connexion_bd.php');

    //variables de recupération des infos du stagiaire
    $ids = isset($_POST['idS'])?$_POST['idS']:0;
    $nom = strtoupper(isset($_POST['nom'])?$_POST['nom']:"");
    $prenom = strtoupper(isset($_POST['prenom'])?$_POST['prenom']:"");
    $idFiliere = isset($_POST['idFiliere'])?$_POST['idFiliere']:1;
    $civilite = isset($_POST['civilite'])?$_POST['civilite']:"F";

    $photo = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";/*quand on récupère la photo elle est stockée sur le server temporairement, on va déclarer une variable pour la récupèrer*/
    
    $image_temporaire=$_FILES['photo']['tmp_name'] ;/*
    la variable globale $_FILES prend 2 paramètres;
    ['photo'] (correspond au name dans editer_stagiaire.php) ;
    ['nom_temporaire']: récupère le nom de la photo  cette variable permet de récupérer le nom et l'emplacement temporaire de notre photo sur le server ;
    ['tmp_name'] est le nom du chemin temporaire de la photo sur le server web*/
   
    /*on utiliser une méthode permettant de déplacer  la photo sur le server pour la mettre dans un dossier qu'on veut (images) */  
    move_uploaded_file($image_temporaire, "../images/".$photo);/*on deplace la photo stockée sur le server par le chemin $image_temporaire vers notre dossier images sous le nom de $photo*/
    
   if(!empty($photo)){//si $photo est non vide on exécute cette réquête en mettant à jour la photo
        //requête de mise à jour des infos du stagiaire dans la base de données
        $requete = "update  stagiaire set nom=?, prenom=?, civilite=?, idFiliere=?, photo=?  where idStagiaire=?";
        $params = array( $nom, $prenom, $civilite, $idFiliere, $photo, $ids);
       }else{//sinon on ne change la photo
           $requete = "update  stagiaire set nom=?, prenom=?, civilite=?, idFiliere=?  where idStagiaire=?";
            $params = array( $nom, $prenom, $civilite, $idFiliere, $ids);
   }
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    //une fois la mise à, jour terminée, on se retourne vers la page des stagiaires
    header('location:stagiaires.php');
   
?>