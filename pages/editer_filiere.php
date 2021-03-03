<?php
    require_once('identification.php');
    require_once('connexion_bd.php');
    
    //variable pour recupérer l'id de la filière
    $idf = isset($_GET['idF'])?$_GET['idF']:0;//voir la page filieres.php où se trouve le lien de editer_filiere.php pour comprendre le choix de la methode get()

    //requête pour recupérer l'id de la filière dans la base de données
    $requete = "select * from filiere where idFiliere=$idf";
    $resultat = $pdo->query($requete);//query() est utilisé pour les requêtes de sélection
    
    //variable de recuperation deu resultat de la requête dans un tableau associatif
    $filiere = $resultat->fetch();
    
    //recupération du nom et du niveau de la filière
    $nomf = strtoupper($filiere['nomFiliere']);
    $niveau = strtoupper($filiere['niveau']);

?>



<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edition d'une filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <!--pour apprendre bootstrap : voir w3schools -->
        <!--une div permet de diviser une page en plusieurs morceaux -->
         <div class="container"><!--container permet d'appliquer une marge gauche et une marge droite       et de centrer le contenu -->
            
         <!--nouveau panneau -->
            <div class="panel panel-primary margetop"><!--panel permet de créer des panneaux -->
                <div class="panel-heading">Edition de la filière </div>
                <div class="panel-body">
                    
                     <form method="post" action="update_filiere.php" class="form">
                         
                          
                        <div class="form-group">
                            <label for="nom">Id de la filière:<?php echo "$idf" ?></label>
                            <input type="hidden" name="idF" class="form-control" value="<?php echo "$idf" ?> ">
                        </div>
                         
                        <div class="form-group">
                            <label for="nom">Nom de la filière:</label>
                            <input type="text" name="nomF" placeholder="Tapez le nom de la filière" class="form-control" value="<?php echo "$nomf" ?> " >
                        </div>
                         
                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
                            <select name="niveau" id="niveau" class="form-control" ><!--onchange="this.form.submit()" joue le rôle de la touche enter sur le clavier-->                       
                                <option value="B" 
                                        <?php if($niveau=="B") echo "selected" ?> >Baccalaureat
                                </option>
                                <option value="BT" 
                                        <?php if($niveau=="BT") echo "selected" ?> >Brevet technique
                                </option>
                                <option value="L1" 
                                        <?php if($niveau=="L1") echo "selected" ?> >Licence1
                                </option>
                                <option value="L2" 
                                        <?php if($niveau=="L2") echo "selected" ?> >Licence2
                                </option>
                                <option value="M1"
                                        <?php if($niveau=="M1") echo "selected" ?> >Master1
                                </option> 
                                <option value="M2" 
                                        <?php if($niveau=="M2") echo "selected" ?> >Master2
                                </option>
                             </select>
                         </div>
                         
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span> Enrégistrer
                        </button>
                        
                    </form>
                    
                </div> 
            </div>
            
        </div>
    
    
    </body>
</html> 