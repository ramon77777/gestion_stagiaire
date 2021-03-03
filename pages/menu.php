<?php
    require_once('identification.php');

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
     <!--nav est une balise qui permet de créer un menu ou une barre d'une navigation-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <!--navabr indique qu'on a une barre de navigation; navbar-inverse indique le thème(le noir avec inverse et le gris avec default) ;navbar-fixe-top permet de fixer tout le temps le menu au sommet de la page-->

        <div class="container_fluid"><!--container-fluid permet au menu de s'adapter à tous les écrans(taile)-->
            <div class="navbar-header"><!--navbar-header est utilisé pour les titres-->

                <a href="../index.php" class="navbar-brand">Gestion des stagiaires</a>
                    <!--navbar-brand permet de créer un titre semblable à un style h3 -->
            </div>

            <ul class="nav navbar-nav"><!--nav navbar-nav permet de dire voici mon menu de navigation-->
                <li><a href="stagiaires.php">
                        <i class="fa fa-vcard"></i>
                        &nbsp Les stagiaires
                    </a>
                </li>
                <li><a href="filieres.php">
                         <i class="fa fa-tags"></i>
                            Les filières
                    </a>
                </li>
            <?php if($_SESSION['user']['role']=="ADMIN") {?> 
                <li><a href="utilisateurs.php">
                        <i class="fa fa-users"></i>
                        Les utilisateurs
                    </a>
                </li>
            <?php  } ?>
            </ul>

            <ul class="nav navbar-nav navbar-right"><!--nav navbar-nav permet de dire voici mon menu de navigation-->
                <li>
                    <a href="editer_utilisateur.php?id=<?php echo $_SESSION['user']['idUtilisateur'] ?>"><i class="glyphicon glyphicon-user"></i> 
                        <?php echo ' '. $_SESSION['user']['login'] //ceci permet d'afficher le nom de l'utilisateur ?>
                    </a>
                </li>

                <li>
                    <a href="deconnexion.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Se               déconnecter
                    </a>
                </li>

            </ul>

        </div>

    </nav>

    </body>
</html>