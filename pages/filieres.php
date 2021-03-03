<?php
   require_once('identification.php');
    
    /*-include("connexion_bd.php"): include va copier le code source de la page connexion_bd.php sur cette page avant de l'exécuter et afficher le resultat.
    
    -require("connexion_bd.php"):va exécuter d'abord le contenu de la page connexion_bd.php et venir copier le resultat sur cette page.
    
    -require_once("connexion_bd.php"):idem à require mais il va d'abord voir dans la mémoire s'il n'ya pas une instance de "connexion_bd.php" et la copier directement sinon il va agir maintenant comme require()
    */

    require_once("connexion_bd.php"); 
    
    
   //on va créer des varaibles pour recupérer le nom et le niveau de la filière qui sera recherchée
   $nomf = isset($_GET['nomF'])?$_GET['nomF']:"";/*isset() va verifier si le nomF existe, si oui on le recupère, si non on recupère une chaîne vide */
   $niveau = isset($_GET['niveau'])?$_GET['niveau']:"ALL";
    
    
    $size = isset($_GET['size'])?$_GET['size']:6;//le nombre de ligne et offset est le nombre de saut
    $page = isset($_GET['page'])?$_GET['page']:1; //pour le numero de la page
    $offset = ($page-1)*$size;

    //on va créer une requête permetant de recupérer toutes les filières
    if($niveau=="ALL"){
        $requete = "select * from filiere where nomFiliere like '%$nomf%' limit $size offset $offset";
        
        //on va créer une requête pour compter le nombre de la filière recherchée 
        $requetecount = "select count(*) countF from filiere where nomFiliere like '%$nomf%'";
        
    }else{//ici le nom du niveau est spécifié 
        $requete = "select * from filiere where nomFiliere like '%$nomf%'and niveau='$niveau' limit $size offset $offset";
        
        $requetecount = "select count(*) countF from filiere where nomFiliere like '%$nomf%'and niveau='$niveau'";
    }

    //le resultat de la requête (la recherche des filières)
    $resultatF = $pdo->query($requete);

    //resultat de la requête du comptage
    $resultat = $pdo->query($requetecount);
    $tabcount = $resultat->fetch();
    $nombre_filiere = $tabcount['countF'];

    $reste = $nombre_filiere % $size ;
    if($reste===0){
        $nombre_page = $nombre_filiere / $size;
    }else
        $nombre_page = floor($nombre_filiere / $size) + 1;//floor() permet de recupérer la partie d'un nobre decimal

?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des filières</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
    
        <!--on va metre le panneau au milieu de la page grace à la classe container -->
        <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite et     de centrer le contenu -->
            
            <div class="panel panel-success margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Rechercher des filières</div>
                <div class="panel-body">
                    
                    <form method="get" action="filieres.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomF" placeholder="Tapez le nom de la filière" class="form-control" value="<?php echo $nomf ; ?>">
                        </div>
                        <label for="niveau">Niveau:</label>
                        <select name="niveau" id="niveau" class="form-control" onchange="this.form.submit()"><!--onchange="this.form.submit()" joue le rôle de la touche enter sur le clavier -->
                            <option value="ALL" 
                                <?php if($niveau==="ALL") echo "selected" ?> >Tous les niveaux</option>
                            <option value="B"   
                                <?php if($niveau==="B") echo "selected" ?> >Baccalaureat</option>
                            <option value="BT"  
                                <?php if($niveau==="BT") echo "selected" ?> >Brevet technique</option>
                            <option value="L1"  
                                <?php if($niveau==="L1") echo "selected" ?> >Licence1</option>
                            <option value="L2"  
                                <?php if($niveau==="L2") echo "selected" ?> >Licence2</option>
                            <option value="M1"  
                                <?php if($niveau==="M1") echo "selected" ?> >Master1</option> 
                            <option value="M2"  
                                <?php if($niveau==="M2") echo "selected" ?> >Master2</option>
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> Rechercher... 
                        </button>
                        &nbsp; &nbsp;
                        
                        <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                            <!-- ceci veut dire si l'utilisateur n'est pas un administrateur, il ne peut pas ajouter une nouvelle filière --> 
                            <a href="nouvelle_filiere.php">
                                <span class="glyphicon glyphicon-plus"></span>Nouvelle filière
                            </a>
                        <?php    } ?>
                        
                    </form>
                    
                </div> 
            </div>
            
            <!--nouveau panneau -->
            <div class="panel panel-primary "><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Liste des filières(<?php echo $nombre_filiere ?> Filières)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        
                        <thead>
                            <tr>
                                <th>Id filière</th>
                                <th>Nom filière</th>
                                <th>Niveau filière</th>
                                
                                <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                                    <th>Actions</th>
                                <?php    } ?>
                            </tr>
                        </thead>
                        
                        <tbody>
                             
                               <?php
                                 /*affichage des resultats sous forme d'un tableau associatif avec la fonction fetch()*/
                                 
                                 while($filiere = $resultatF->fetch()){  ?>
                                    <tr>
                                        <td> <?php echo $filiere['idFiliere'] ?></td>
                                        <td> <?php echo $filiere['nomFiliere'] ?></td>
                                        <td> <?php echo $filiere['niveau'] ?></td>
                                        
                                    <?php if($_SESSION['user']['role']=='ADMIN'){ ?>
                                        <td>
                                            <a href="editer_filiere.php?idF=<?php echo $filiere['idFiliere'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            
                                            &nbsp;
                                            
                                            <a onclick="return confirm('Etes-vous sûr de vouloir supprimer cette filière ?')"
                                               href="supprimer_filiere.php?idF=<?php echo $filiere['idFiliere'] ?> ">
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
                                   <a href="filieres.php?page= <?php  echo $i ; ?>&nomF=<?php echo $nomf; ?>&niveau=<?php echo $niveau; ?>" > 
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