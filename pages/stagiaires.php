<?php
    require_once('identification.php');
    /*-include("connexion_bd.php"): include va copier le code source de la page connexion_bd.php sur cette page avant de l'exécuter et afficher le resultat.
    
    -require("connexion_bd.php"):va exécuter d'abord le contenu de la page connexion_bd.php et venir copier le resultat sur cette page.
    
    -require_once("connexion_bd.php"):idem à require mais il va d'abord voir dans la mémoire s'il n'ya pas une instance de "connexion_bd.php" et la copier directement sinon il va agir maintenant comme require()
    */

    require_once("connexion_bd.php"); 
    
    
   //on va créer des varaibles pour recupérer le nom et le niveau de la filière qui sera recherchée
   $nom_prenom = isset($_GET['nom_prenom'])?$_GET['nom_prenom']:"";/*isset() va verifier si le nomF existe, si oui on le recupère, si non on recupère une chaîne vide */
   $idfiliere = isset($_GET['idfiliere'])?$_GET['idfiliere']:0;//0 pour toutes les filières
    
    
    $size = isset($_GET['size'])?$_GET['size']:4;//le nombre de ligne et offset est le nombre de saut
    $page = isset($_GET['page'])?$_GET['page']:1; //pour le numero de la page
    $offset = ($page-1)*$size;

    //on créer une requete pour recupérer les filières dans la base de données
    $requete_filiere = "select * from filiere" ;

    
    if($idfiliere==0){
        $requete_stagiaire = "select idStagiaire, nom, prenom, nomFiliere, photo, civilite from filiere        as f, stagiaire as s where f.idFiliere=s.idFiliere and (nom like '%$nom_prenom%' or            prenom like '%$nom_prenom%') order by idStagiaire limit $size offset $offset";
        
        //on va créer une requête pour compter le nombre de stagiaires  
        $requetecount = "select count(*) countS from stagiaire where nom like '%$nom_prenom%' or prenom      like '%$nom_prenom%'";
        
    }else{
        $requete_stagiaire = "select idStagiaire, nom, prenom, nomFiliere, photo, civilite from filiere      as f, stagiaire as s where f.idFiliere=s.idFiliere and (nom like '%$nom_prenom%' or            prenom like '%$nom_prenom%') and f.idFiliere=$idfiliere order by idStagiaire limit $size          offset $offset";
        
        //on va créer une requête pour compter le nombre de stagiaires  
        $requetecount = "select count(*) countS from stagiaire where (nom like '%$nom_prenom%' or prenom         like '%$nom_prenom%') and idFiliere=$idfiliere ";
    }
    
    //le resultat de la requête (la recuperation des filières)
    $resultat_filiere = $pdo->query($requete_filiere);

    //le resultat de la requête (la recherche des stagiaires)
    $resultat_stagiaire = $pdo->query($requete_stagiaire);

    //resultat de la requête du comptage
    $resultat = $pdo->query($requetecount);
    $tabcount = $resultat->fetch();
    $nombre_stagiaire = $tabcount['countS'];

    $reste =  $nombre_stagiaire % $size ;
    if($reste===0){
        $nombre_page =  $nombre_stagiaire / $size;
    }else
        $nombre_page = floor( $nombre_stagiaire / $size) + 1;//floor() permet de recupérer la partie d'un nobre decimal

?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des stagiaires</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
    
        <!--on va metre le panneau au milieu de la page grace à la classe container -->
        <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite et     de centrer le contenu -->
            
            <div class="panel panel-success margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Rechercher des stagiaires</div>
                <div class="panel-body">
                    
                    <form method="get" action="stagiaires.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nom_prenom" placeholder="Tapez le nom et le prenom du stagiaire" class="form-control" value="<?php echo $nom_prenom ; ?>">
                        </div>
                        <label for="idfiliere">Filière:</label>
                        <select name="idfiliere" id="idfiliere" class="form-control" onchange="this.form.submit()"><!--onchange="this.form.submit()" joue le rôle de la touche enter sur le clavier -->
                            <option value=0>Toutes les filières</option>
                            <?php while($filiere=$resultat_filiere->fetch()){ ?>
                                <option value="<?php echo $filiere['idFiliere'] //on envoi l'id de la filière mais c'est le nom qui est affichié ?>"
                                    <?php if( $filiere['idFiliere']===$idfiliere) echo "selected" ?> > 
                                    <?php echo $filiere['nomFiliere'] ?>
                                </option>
                            <?php } ?>
                            
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> Rechercher... 
                        </button>
                        &nbsp; &nbsp;
                    <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                        <a href="nouveau_stagiaire.php">
                            <span class="glyphicon glyphicon-plus"></span>Nouveau stagiaire
                        </a>
                    <?php    } ?>
                        
                    </form>
                    
                </div> 
            </div>
            
            <!--nouveau panneau -->
            <div class="panel panel-primary "><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Liste des stagiaires(<?php echo $nombre_stagiaire ?> Stagiaires)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        
                        <thead>
                            <tr>
                                <th>Id stagiaire</th>
                                <th>Nom </th>
                                <th>Prenom </th>
                                <th>Filière </th>
                                <th>Photo </th>
                                
                                <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                                    <th>Actions</th>
                                <?php    } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                             
                               <?php
                                 /*affichage des resultats sous forme d'un tableau associatif avec la fonction fetch()*/
                                 
                                 while($stagiaire = $resultat_stagiaire->fetch()){  ?>
                                    <tr>
                                        <td> <?php echo $stagiaire['idStagiaire'] ?></td>
                                        <td> <?php echo $stagiaire['nom'] ?></td>
                                        <td> <?php echo $stagiaire['prenom'] ?></td>
                                        <td> <?php echo $stagiaire['nomFiliere'] ?></td>
                                        <td> 
                                            <img src="../images/<?php echo $stagiaire['photo'] ?>" width="50" height="50px" class="img-circle" >
                                        </td>
                                 <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                                        <td>
                                            <a href="editer_stagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce stagiaire ?')"
                                               href="supprimer_stagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?> ">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    <?php    } ?>
                                        
                                     </tr>
                            
                                <?php } ?>
                                 
                                
                            
                        </tbody>
                    
                    </table>
                    <div>
                        <ul class="pagination ">
                            <?php for($i=1; $i<=$nombre_page; $i++){ ?>
                               <li class=" <?php if($i==$page) echo 'active' ?> "> 
                                   <a href="stagiaires.php?page= <?php  echo $i ; ?>&nom_prenom=<?php echo $nom_prenom; ?>&idfiliere=<?php echo $idfiliere; ?>" > 
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