<?php
    require_once('identification.php');
    require_once('connexion_bd.php');
    require_once('../les fonctions/fonctions.php');

    
    $login_u = $_SESSION['user']['login'];
    $email_u = $_SESSION['user']['email'];
    $idu = $_SESSION['user']['idUtilisateur'];
    $message = "";
    $interval = 3 ;//le temps d'affichage du message($message)
    $url = "login.php";//la rédirection

    //variables de recupération des infos de l'utilisateur
    //$idu = isset($_POST['iduser']);
    $login = $_POST['login'];
    $email = $_POST['email'];
    $envoyer = isset($_POST['envoyer']);
   
    if($envoyer)
    {  
        if(isset($login) &&  isset($email) && !empty($login) && !empty($email))
        {
           if($login == $login_u)//Si les logins sont égaux
           {  
                   if($email == $email_u)
                   {
                        $message = "<div class='alert alert-warning'>
                                 aucun changement d'information !!!
                          </div>" ;

                   }else
                   {
                       $recherche_email = rechercher_par_email($email);
                       
                       if($recherche_email == 0)
                       {
                            $requete = "update utilisateur set email=? where idUtilisateur=?";
                            $params = array($email, $idu);
                            $resultat = $pdo->prepare($requete);
                            $resultat->execute($params);
                            $email_u = $_SESSION['user']['email'] = $email;
                        
                            $message = "<div class='alert alert-success'>
                                    <strong>Félicitation</strong> Votre email a été changé avec succès !!!
                            </div>" ;
                
                         
                        }else
                        {
                            
                            $message = "<div class='alert alert-danger'>
                            <strong>Erreur!</strong>Cet émail existe déjà, veuillez saisir un autre!!!!
                            </div>" ;    

                            $url = $_SERVER['HTTP_REFERER'];   
                        }
                    }

            }else//sinon si les logins sont différents
            {
                $recherche_login = rechercher_par_login($login);

                if($recherche_login == 0)
                {
                    if($email == $email_u)
                    {   $requete = "update utilisateur set login=? where idUtilisateur=?";
                        $params = array($login, $idu);
                        $resultat = $pdo->prepare($requete);
                        $resultat->execute($params);
                        $login_u = $_SESSION['user']['login'] = $login;
                    
                        $message = "<div class='alert alert-success'>
                                <strong>Félicitation</strong> Votre login a été changé avec succès !!!
                        </div>" ;   
                    }else
                    {
                        $recherche_email = rechercher_par_email($email);
                        
                        if($recherche_email == 0)
                        {
                            $requete = "update utilisateur set login=?, email=? where idUtilisateur=?";
                            $params = array($login,$email, $idu);
                            $resultat = $pdo->prepare($requete);
                            $resultat->execute($params);
                            $email_u = $_SESSION['user']['email'] = $email;
                            $login_u = $_SESSION['user']['login'] = $login;
                        
                            $message = "<div class='alert alert-success'>
                                    <strong>Félicitation</strong> Vos informations ont été changé avec succès !!!
                            </div>" ;
                
                        ;    
                        }else
                        {
                            
                            $message = "<div class='alert alert-danger'>
                            <strong>Erreur!</strong>Cet émail existe déjà, veuillez saisir un autre!!!!
                            </div>" ;    

                           $url = $_SERVER['HTTP_REFERER'];   
                        }
                    }
                   
                      
                }// login_search
                else
                {
                    $message = "<div class='alert alert-danger'>
                                 <strong>Erreur!</strong>Ce login existe déjà, veuillez saisir un autre!!!!
                             </div>" ;    
                              $url = $_SERVER['HTTP_REFERER']; 
                }
            }
        }else
        {
            $message = "<div class='alert alert-danger'>
                                 <strong>Veuillez saisir vos infromations svp!!!</strong>
                             </div>" ;    
                      $url = $_SERVER['HTTP_REFERER']; 
        }
    }
        
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Update utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    </head>
    <body>
    
        <div class="container">
            
            <br><br>
            
            <?php
                echo $message ;
        
           header("refresh:$interval; url=$url");//cela permet d'afficher le message($message) pendant un certain temps ($interval) et ensuite rédiriger l'utilisateur vers la page de l'url
            
            ?>
            
        </div>
    
    </body>
</html>

