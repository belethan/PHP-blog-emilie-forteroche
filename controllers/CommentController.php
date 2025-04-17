<?php

class CommentController 
{
    /**
     * Ajoute un commentaire.
     * @return void
     */
    public function addComment() : void
    {
        // Récupération des données du formulaire.
        $pseudo = Utils::request("pseudo");
        $content = Utils::request("content");
        $idArticle = Utils::request("idArticle");

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($content) || empty($idArticle)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        // On vérifie que l'article existe.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($idArticle);
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        // On crée l'objet Comment.
        $comment = new Comment([
            'pseudo' => $pseudo,
            'content' => $content,
            'idArticle' => $idArticle
        ]);

        // On ajoute le commentaire.
        $commentManager = new CommentManager();
        $result = $commentManager->addComment($comment);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du commentaire.");
        }

        // On redirige vers la page de l'article.
        Utils::redirect("showArticle", ['id' => $idArticle]);
    }

    Public function DatatableComment() : void
    {
        /* Récupération des données POST */
        $id = Utils::request("id", -1);
        $draw = Utils::request("draw", 1 );
        $start = Utils::request('start',1);
        $length = Utils::request('length',null);
        $order = Utils::request('order',null);
        /* Référencement des colonnes d'un tableau */
        $columns = ['title','A.id', 'A.id_article', 'A.pseudo', 'A.content','A.date_creation'];
        $tridatable = "";
        /* extraction pour le tri sur la colonne choisit */
        if (!empty($order[0]['column'])) {
            $orderColumnIndex = $order[0]['column'];
            $orderDir = $order[0]['dir'];
            $orderColumn = $columns[$orderColumnIndex] ?? "";
            $tridatable = " ORDER BY $orderColumn $orderDir";
        }
        /* Requete affichage des donnés */
        $CommentManager = new CommentManager();
        $total = $CommentManager->getCountAllComment();
        $data = $CommentManager->ListCommentTable($id,$tridatable);
        // Format JSON attendu par DataTables
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "data" => $data
        ];
        /* - Le type MIME de la réponse est défini comme **JSON** */
        header('Content-Type: application/json');
        /* encodage de la réponse en JSON */
        $infoData =json_encode($response,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        echo $infoData;
    }

    /**
     * Affiche le titre et les commentaires d'un article.
     * @return void
     */
    Public function ShowTitleComment() : void
    {
        $id = Utils::request("id", -1);

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }
        $view = new View("Titre");
        $view->render("CommentListe");
    }
}