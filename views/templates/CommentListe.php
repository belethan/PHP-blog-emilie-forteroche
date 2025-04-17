<?php
    /**
     * Ce template affiche les commentaires d'un article.
     */
?>
<h2> Liste des Commentaires </h2>
<h3> Titre article : <?= Utils::format($article->getTitle()) ?> </h3>
<table id="TableMemo" class="display" style="width:100%">
    <thead>
    <tr>
        <th>id</th>
        <th>Pseudo</th>
        <th>Crée le</th>
        <th>Commentaire</th>
        <th>Supprimer</th>
    </tr>
    </thead>
</table>