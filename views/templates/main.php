<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emilie Forteroche</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav>
        <ul class="menu">
          <li>  <a href="index.php">Articles</a> </li>
          <li>  <a href="index.php?action=apropos">À propos</a> </li>
            <?php 
                // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                if (isset($_SESSION['user'])) {
                    echo ' <li class="menu-item"> <a href="index.php?action=disconnectUser">Connecté : Coquemert  Ludovic</a>';
                    echo ' <ul class="submenu">';
                        echo '<li> <a href="#">Liste des articles</a> </li>';
                        echo '<li> <a href="#">Liste des commentaires</a> </li>';
                        echo '<li> <a href="#">Liste des Utilisateurs</a> </li>';
                    echo '</ul> </li>';
                    echo '<li><a href="index.php?action=disconnectUser">Déconnexion</a></li>';
                }
            ?>

        </ul>
        </nav>
        <h1>Emilie Forteroche</h1>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <p>Copyright © Emilie Forteroche 2023 - Openclassrooms - <a href="index.php?action=admin">Admin</a>
    </footer>

</body>
</html>