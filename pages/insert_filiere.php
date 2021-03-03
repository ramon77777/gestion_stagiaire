<?php
    require_once('identification.php');
    require_once('connexion_bd.php');

    //variables de recupération du nom et du niveau de la filière
    $nomf = strtoupper(isset($_POST['nomF'])?$_POST['nomF']:"");
    $niveau = strtoupper(isset($_POST['niveau'])?$_POST['niveau']:"");

    //requête d'insertion du nom et du niveau dans la base de données
    $requete = "insert into filiere(nomFiliere, niveau) values(?, ?)";
    $params = array($nomf, $niveau);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    //une fois les données inserrées , on se retourne vers la page des filières
    header('location:filieres.php');
    
    //tuto 9
?>