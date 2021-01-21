<?php


namespace blog\app\views;


class Comment extends \blog\app\controllers\Comment
{
    public function showCommentWithArticle()
    {

        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

            $article_id = $_GET['id'];
            $currentPage = $this->getStart();

            $nbComment = $this->nbrCommentId();

            $parPage = 5;

            $pages = ceil($nbComment / $parPage);
            // Calcul du 1er article de la page
            $premier = ($currentPage * $parPage) - $parPage;

            $comment = $this->showComments($article_id, $premier, $parPage);

            foreach ($comment as $key => $value) {

                echo '<br>' . 'Commentaire :' . $value['commentaire'] . '<br>' . 'écrit le :' . $value['date'] . '<br>';

            }

            $this->showPaginationComment($article_id, $currentPage, $pages);

        }
    }

    public function getStart()
    {
        if (isset($_GET['start']) && !empty($_GET['start'])) {
            $currentPage = (int)strip_tags($_GET['start']);
        } else {
            $currentPage = 1;
        }

        return $currentPage;
    }

    public function showPaginationComment($article_id, $currentPage, $pages)
    {

        if (isset($article_id) && !empty($article_id)) {
            ?>
            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a href="?id=<?= $article_id ?>&start=<?= $currentPage - 1 ?>"
                           class="page-link">Précédente</a>
                    </li>
                    <?php for ($page = 1; $page <= $pages; $page++): ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                            <a href="?id=<?= $article_id ?>&start=<?= $page ?>"
                               class="page-link"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a href="?id=<?= $article_id ?>&start=<?= $currentPage + 1 ?>"
                           class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
            <?php
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
<h2>Liste des commentaires</h2>
<table>
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
    <tbody>
        {$tbody}
    </tbody>
</table>
HTML;
        echo $vue;
    }
}