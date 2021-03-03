<?php
    require_once('connexion_bd.php');
    require_once('../les fonctions/fonctions.php');

    
    /*on va faire un test pour vérifier la méthode que l'utilisateur va utiliser vpour envoyer ses informations lors de la création de compte On va s'assurer qu'il utilise la méthode post*/
    if($_SERVER['REQUEST_METHOD']=='POST'){//en d'autre si l'utilisateur utilise une autre méthode autre que post, il ne pourra pas créer son compte
        
        //récuperation des données de l'utilisateur
        $login = $_POST['login'];
        $pwd1  = $_POST['pwd1'];
        $pwd2  = $_POST['pwd2'];
        $email = $_POST['email'];
        
        //on va créer un tableau pour récupérer tous les messages d'erreur
        $erreur_validation = array();
        
        //on va vérifier si le login respecte notre critère(c-à-d au moins 4  caractères)
        if(isset($login)){//isset() permet de vérifier si une variable existe
            
            //php.net est le site où on peut chercher des fonctions php
            
            //on va filtrer le login de l'utilisateur afin d'éviter les balises html ou encore des caractères qui peuvent créer des failles de sécuriter avec la fonction php FILTER_SANITIZE_STRING
            $filtre_login = filter_var($login, FILTER_SANITIZE_STRING);
            
            //on va maintenant vérifier la taille du login(pour qu'il ait au moins 4 caractères)
            if(strlen($filtre_login) <4){//strlen($filtre_login) va rétourner le nombre caractères de la variable $filtre_login
                //si le nombre de caractères du login est inférieur à 4 on va afficher u message d'erreur
                
                $erreur_validation[] = "Erreur!!! Le login doit contenir au moins 4 caractères";
                
            }
            
        }
        
        //on va vérifier maintenant le mot de passe s'il respecte notre critère(c-à-d au moins 3  caractères)
        if(isset($pwd1) && isset($pwd2)){ 
            
          //empty() permet de vérifier si une varaible n'est pas vide, elle retourn true si la variable n'est pas vide et false si elle est vide
            if(empty($pwd1)){//en d'autre terme si le premier mot de passe est vide on affiche le message d'erreur 
                $erreur_validation[] = "Erreur!!! Le mot de passe ne peut pas être vide";   
            }
            
            //on va vérifier l'égalité des 2 mots de passe
            if(md5($pwd1)!==md5($pwd2)){//si le 1er mot de passe n'est pas égal(!==) ou différent(!=) du 2ème on affiche une erreur
                $erreur_validation[] = "Erreur!!! Les deux mots de passe ne sont pas identiques";   
            }
            
        }
        
        //on va contrôler l'email avant de le valider
        
        if(isset($email)){
            
            $filtre_email = filter_var($email, FILTER_SANITIZE_EMAIL);
            
            //on va vérifier la forme de l'email pour d'assurer qu'il est valide
            
            if($filtre_email !=true){//si le filtrage de l'email retourne faux, on affiche le message d'erreur
                
                $erreur_validation[] = "Erreur!!! Email non valide";
            }
        }
        
        //on va vérifier si y a une erreur ou pas avant de recupérer les données
        
        if(empty($erreur_validation)){//si le tableau des erreurs est vides alors on commncer à recupérer les données
            
            //mais avant d'insérer le nouvel utilisateur on s'assurer de son unicité
            
            //ainsi on va faire une recherche par login d'abord
            if(rechercher_par_login($login)==0 && rechercher_par_email($email)==0){
                //si les 2 recherches donnent 0 alors cet utilisateur n'existe pas encore dans notre base de données, on peut donc l'inserer
                
                //on va faire la réquête d'insertion
                $requete = $pdo->prepare("insert into utilisateur(login, email, pwd, role, etat) values(:plogin, :pemail, :ppwd, :prole, :petat)");/*(:plogin, :pemail, :ppwd, :prole, :petat) ceci est un tableau descriptif où chaque paramètre a sa valeur; 
                * :plogin veut paramètre(p) login
                on pouvait aussi utiliser biensûr les ? */
                
                //exécution de la requête
                $requete->execute(array(
                    ':plogin' =>$login,//:plogine est la clé(l'index dans le tableau) et $login est la valeur
                    ':pemail' =>$email,
                    ':ppwd'   =>md5($pwd1),//$pwd1 ou $pwd2 , les 2 marchent
                    ':prole'  =>'VISITEUR',//par défaut on va attribuer le rôle de visiteur à l'utilisateur
                    ':petat'  => 0//par défaut on va désactiver le nouvel utilistaeur
                    )); 
                
                
                //on va céer une variable pour envoyer un message de  confirmation du compte
                $success_message = "Félicitaion, votre a été  bien crée, mais il est temporairement inactif jusqu'à l'activation par un administrateur";
                
            }else{
                
                if(rechercher_par_login($login)>0){
                
                    $erreur_validation[]='Desolé ce login existe déjà!!! Veuillez choisir un autre';
                
                                                  }
            
            if(rechercher_par_email($email)>0){
                
                $erreur_validation[]='Desolé cet email existe déjà!!! Veuillez choisir un autre';
                
                                               }
               }
            
        }
            
    }

?>




<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvel utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    
    </head>
    
    <body>
    
        <div class="container col-md-6 col-md-offset-3"><!--col-md-6 col-md-offset-3 veut dire: laisser 3 colonnes sur la gauche et 3 colonnes sur la droite-->
            
            <h1 class="text-center">Création d'un nouveau compte utilisateur</h1>
          
            <form class="form" method="post" action="nouvel_utilisateur.php">
            
                <!--Choix du login -->
                <div class="input-container">
                     <input type="text" name="login" class="form-control" minlength=4 title="Le login doit contenir au moins 4 caractères..." placeholder="Saisissez votre nom d'utilisateur" autocomplete="off" required >
                </div>

                <!--Choix du mot passe -->
                <div class="input-container">
                     <input type="password" name="pwd1" class="form-control" minlength=3 title="Le mot de pase  doit contenir au moins 3 caractères..." placeholder="Saisissez votre mot de passe" autocomplete="new-password" required >
                </div>

                <!--Confirmation du mot de passe -->
                <div class="input-container">
                     <input type="password" name="pwd2" class="form-control" minlength=3 title="Le mot de pase  doit contenir au moins 3 caractères..." placeholder="Confirmez votre mot de passe" autocomplete="new-password" required >
                </div>

                <!--Choix de l'email -->
                <div class="input-container">
                     <input type="email" name="email" class="form-control" placeholder="Saisissez votre email" autocomplete="off" required >
                 </div>

                <input type="submit" class="btn btn-primary" value="Enrégistrer">
            
            </form>
            
            <br>
            
            <?php
                /*Avant de parcourir le tableau on va s'assurer qu'il existe et qu'il contient des éléments*/
                if(isset($erreur_validation) && !empty($erreur_validation)){
                    
                         //foreach = pour chaque
                    /*la boucle foreach() permet de parcourir un ensemble d'élément et d'exécuter un monceau de code pour chaque élément. Exemple, pour notre tableau d'erreur (qui contient toutes les erreurs enrégistrées), foreach() va le parcourir et à chaque fois qu'elle va tomber sur un erreur elle va l'afficher*/

                    foreach( $erreur_validation as $erreur){//c-à-d pour chaque erreur rencontrée $erreur la récupère et on l'affiche sinon on affiche rien 
                    
                    echo '<div class="alert alert-danger">'.$erreur.'</div>';
                }
            
                }
            
            if(isset($success_message) && !empty($success_message)){
                
                echo '<div class="alert alert-success">'.$success_message.'</div>';
                
                header('refresh:5; url=login.php');
            }
               
            ?>
            
            
            
        </div>
    
    
    </body>

</html>