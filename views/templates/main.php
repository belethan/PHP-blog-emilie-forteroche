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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

</head>

<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Articles</a></li>
            <li><a href="index.php?action=apropos">À propos</a></li>
            <?php
            // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion :
            if (isset($_SESSION['user'])) {
                //$user_actif =;
                echo ' <li class="menu-item"> <a href="#">Connecté :' . $_SESSION['login'] . '</a>';
                echo ' <ul class="submenu">';
                echo '<li> <a href="index.php?action=admin">Liste des articles</a> </li>';
                echo '<li> <a href="index.php?action=ShowStatistics">Liste des commentaires</a> </li>';
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#TableBlog').DataTable({
               processing: true,
               serverSide: true,
               paging:false,
               info: false,
               searching:false,
                order: [[1, 'asc']],
                ajax: {
                    url: 'index.php?action=showStatisticsArticle',
                    type: 'POST'
                },
                columns: [
                    { data: 'id',
                        visible:false,
                        orderable: false
                    },
                    { data: 'datecreation'  },
                    { data: 'title'  },
                    { data: 'nbvues'  },
                    { data: 'qteCommentaires'  },
                    {data: 'details'    }
                ],
                columnDefs: [
                    { width: "50px", targets: 0 },
                    { width: "140px", targets: 1 },
                    { width: "380px", targets: 2 },
                    { width: "50px", targets: 3 },
                    { width: "50px", targets: 4 },
                    {
                        width: "100px",
                        targets: 5,
                        orderable: false,
                        render:function(data, type, row) {
                            var id = row.id; // Supposons que l'ID est dans la 1ère colonne
                            return '<a href="details.php?id=' + id + '" class="comment-btn">Voir</a>';
                        }
                    },
                    { targets: [3], className: 'dt-center' },
                    { targets: [4], className: 'dt-center' },
                    { targets: [5], className: 'dt-center' },
               ],
               scrollX: true
         });
         $('#TableBlog tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected').siblings().removeClass('selected');
         });
    });
</script>
</body>
</html>