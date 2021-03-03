<?php
    function rechercher_par_login($login){
        
        global $pdo; //ici on demande à php de chercher dans les dossiers de l'application une variable appélée $pdo avec le mot clé global
        
        $requete = $pdo->prepare("select * from utilisateur where login=?");
        $requete->execute(array($login));
        
        return $requete->rowCount();/*ceci retourne le nombre de lignes de la requête, ainsi si le login n'existe pas , rowCount() retournera 0(en d'autre terme il n' ya  pas un utilisateur avec ce login)*/ 
        
        
    }

    
    function rechercher_par_email($email){
        
        global $pdo; //ici on demande à php de chercher dans les dossiers de l'application une variable appélée $pdo avec le mot clé global
        
        $requete = $pdo->prepare("select * from utilisateur where email=?");
        $requete->execute(array($email));
        $resultat = $requete->fetch();
        
        return $resultat;/*ceci retourne le nombre de lignes de la requête, ainsi si l'email n'existe pas , rowCount() retournera 0(en d'autre terme il n' ya  pas un utilisateur avec cet email)*/ 
        
        
    }

?>