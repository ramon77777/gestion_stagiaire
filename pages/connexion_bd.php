<?php
    try{
        
        $pdo = new PDO("mysql:host=localhost;dbname=gestion_stagiaire", "root", "", array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e){
        die('Erreur de connexion : '.$e->getMessage());/*cette ligne tupyfie 'donne moi le message d'erreur rencontré' */
        
        
    }

?>