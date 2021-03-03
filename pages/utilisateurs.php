<?php
    require_once('identification.php');
    /*-include("connexion_bd.php"): include va copier le code source de la page connexion_bd.php sur cette page avant de l'exécuter et afficher le resultat.
    
    -require("connexion_bd.php"):va exécuter d'abord le contenu de la page connexion_bd.php et venir copier le resultat sur cette page.
    
    -require_once("connexion_bd.php"):idem à require mais il va d'abord voir dans la mémoire s'il n'ya pas une instance de "connexion_bd.php" et la copier directement sinon il va agir maintenant comme require()
    */

    require_once("connexion_bd.php"); 
    
    
   
   $login = isset($_GET['login'])?$_GET['login']:"";/*isset() va verifier si le nomF existe, si oui on le recupère, si non on recupère une chaîne vide */
  
    
    
    $size = isset($_GET['size'])?$_GET['size']:4;//le nombre de ligne et offset est le nombre de saut
    $page = isset($_GET['page'])?$_GET['page']:1; //pour le numero de la page
    $offset = ($page-1)*$size;

    
    
   
    $requete_user = "select * from utilisateur where login like '%$login%'";
    
    //on va créer une requête pour compter le nombre d'utilisateur' 
    $requetecount = "select count(*) countU from utilisateur";
    //le resultat de la requête (la recuperation des utilisateurs)
    $resultat_utilisateur = $pdo->query($requete_user);

    //resultat de la requête du comptage
    $resultat = $pdo->query($requetecount);
    $tabcount = $resultat->fetch();
    $nombre_utilisateur = $tabcount['countU'];

    $reste =  $nombre_utilisateur % $size ;
    if($reste===0){
        $nombre_page =  $nombre_utilisateur / $size;
    }else
        $nombre_page = floor( $nombre_utilisateur / $size) + 1;//floor() permet de recupérer la partie d'un nobre decimal

?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des utilisateurs</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
    
        <!--on va metre le panneau au milieu de la page grace à la classe container -->
        <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite et     de centrer le contenu -->
            
            <div class="panel panel-success margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Rechercher des utilisateurs</div>
                <div class="panel-body">
                    
                    <form method="get" action="utilisateurs.php" class="form-inline">
                        
                        <div class="form-group">
                            <input type="text" name="login" placeholder="login" class="form-control" value="<?php echo $login; ?>">
                        </div>
                        
                      
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> Rechercher... 
                        </button>
                      
                    </form>
                    
                </div> 
            </div>
            
            <!--nouveau panneau -->
            <div class="panel panel-primary "><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Liste des utilisateurs(<?php echo $nombre_utilisateur?> Utilisateurs)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        
                        <thead>
                            <tr>
                                <th>Login </th>
                                <th>Email </th>
                                <th>Role </th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        
                        <tbody>
                             
                               <?php
                                 /*affichage des resultats sous forme d'un tableau associatif avec la fonction fetch()*/
                                 
                                 while($utilisateur = $resultat_utilisateur->fetch()){  ?>
                                    <tr class="<?php echo $utilisateur['etat']==1?'success':'danger' 
                                            //ceci veut dire si l'etat de l'utilisateur est égal 1 alors la couleur de ligne est vert sinon c'est rouge   ?>">
                                        
                                        <td> <?php echo $utilisateur['login'] ?></td>
                                        <td> <?php echo $utilisateur['email'] ?></td>
                                        <td> <?php echo $utilisateur['role'] ?></td>
                                       
                                        <td>
                                            <a href="editer_utilisateur.php?idU=<?php echo $utilisateur['idUtilisateur'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                               href="supprimer_utilisateur.php?idU=<?php echo $utilisateur['idUtilisateur'] ?> ">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                             &nbsp;&nbsp; 
                                            <a href="activer_utilisateur.php?idU=<?php echo $utilisateur['idUtilisateur'] ?> &etat=<?php echo $utilisateur['etat'] ?>">
                                                <?php
                                                    if($utilisateur['etat']==1)
                                                        echo ' <span class="glyphicon glyphicon-remove"></span>';
                                                    else{
                                                        echo ' <span class="glyphicon glyphicon-ok"></span>';
                                                    }
                                                ?>
                                            </a>
                                            
                                        </td>
                                     
                                     </tr>
                            
                                <?php } ?>
                                 
                                
                            
                        </tbody>
                    
                    </table>
                    <div>
                        <ul class="pagination ">
                            <?php for($i=1; $i<=$nombre_page; $i++){ ?>
                               <li class=" <?php if($i==$page) echo 'active' ?> "> 
                                   <a href="utilisateurs.php?page= <?php  echo $i ; ?>&login=<?php echo $login; ?>" > 
                                       <?php  echo $i ; ?> 
                                   </a> 
                               </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div> 
            </div>
            
        </div>
        
    
    </body>
</html> 