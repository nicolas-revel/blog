<?php


namespace blog\app\views;


class Comment extends \blog\app\controllers\Comment
{
    /**
     * Méthode qui permet d'afficher les commentaires d'un article par rapport à son id
     * @param $currentPage
     * @return false|float
     */
    public function showCommentWithArticle($currentPage) {

        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

            $article_id = $_GET['id'];

            $nbComment = $this->nbrCommentId();

            $parPage = 5;

            $pages = ceil($nbComment / $parPage);
            // Calcul du 1er article de la page
            $premier = ($currentPage * $parPage) - $parPage;

            $comment = $this->showComments($article_id, $premier, $parPage);

            foreach ($comment as $key => $value) {

                $date = explode(' ', $value['date'])[0];
                $dateFr = strftime('%d-%m-%Y',strtotime($date));

                $Hour = explode(' ', $value['date'])[1];
                $HourForm = date('H:i', strtotime($Hour));

                ?>
                <div id="card_accueil">
                    <div id="card_titleComment">
                        <h6 id="title_h6Comment">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?> par : <?= $value['login'] ?></h6>
                    </div>
                    <div id="card_articleText">
                        <p><?= $value['commentaire']; ?></p>
                    </div>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->getDroits() == 42): ?>
                    <div id="card_button">
                        <form action="article.php?id=<?= $_GET['id']?>" method="POST">
                            <button class="buttonCard" name="deleteCom" type="submit">SUPPRIMER LE COMMENTAIRE</button>
                        </form>
                        <?php if(isset($_POST['deleteCom'])): ?>
                            <?php $this->deleteComments($value['id']);
                            \blog\app\Http::redirect("article.php?id=$article_id");?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
            }

            $pagination = new \blog\app\views\Article();
            $pagination->showPagination($url = "?id=", $get = $_GET['id'], $start = "&start=", $currentPage, $pages);
        }


    }

    public function listEachComment()
    {
        $comments = $this->creaTableComment();
        $tbody = '';
        foreach ($comments as $comment) {
            $tbody = $tbody . <<<html
<tr>
    <td>{$comment['id']}</td>
    <td>{$comment['commentaire']}</td>
    <td>{$comment['login']}</td>
    <td>{$comment['id_article']}</td>
    <td>{$comment['date']}</td>
    <td><a href='{$_SERVER['PHP_SELF']}?delCom={$comment['id']}'>Supprimer</a></td>
    <td><a href="article.php?id={$comment['id_article']}&modifcom={$comment['id']}">Modifier</a></td>
    
</tr>
html;
        }
        return $tbody;
    }

    public function tableComment()
    {
        $tbody = $this->listEachComment();
        $vue = <<<HTML
<div class="tableAdmin">
<br>
<h2 id="title_table">Liste des commentaires</h2>
<br>
<table id="table_ad">
    <thead>
        <tr>
            <th>ID</th>
            <th>Commentaire</th>
            <th>Auteur</th>
            <th>Id de l'article lié</th>
            <th>Date</th>
            <th>Supprimer le commentaire</th>
            <th>Modifier le commentaire</th>
        </tr>
    </thead>
    <tbody id="table_body">
        {$tbody}
    </tbody>
</table>
HTML;
        echo $vue;
    }
}