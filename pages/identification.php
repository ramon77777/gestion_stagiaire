<?php
     session_start();
    
    if(!isset($_SESSION['user']))//si l'utilisateur n'est pas connecté on le rédige vers la page de connection car il n'est pas accéder au menu sans si son compte n'est pas activé
        header('location:login.php');

?>