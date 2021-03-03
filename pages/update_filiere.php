<?php
    require_once('identification.php');
    require_once('connexion_bd.php');

    //variables de recupération de l'id, du nom et du niveau de la filière
    $idf = isset($_POST['idF'])?$_POST['idF']:0;
    $nomf = strtoupper(isset($_POST['nomF'])?$_POST['nomF']:"");
    $niveau = isset($_POST['niveau'])?$_POST['niveau']:"";

    //requête de mise à jour du nom et du niveau dans la base de données
    $requete = "update  filiere set nomFiliere=?, niveau=? where idFiliere=?";
    $params = array($nomf, $niveau, $idf);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    //une fois la mise à, jour terminée, on se retourne vers la page des filières
    header('location:filieres.php');

?>