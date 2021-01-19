<?php

namespace blog\app\views;

class view {

    /**
     * Méthode qui permet de générer la pagination selon l'url, Méthode commune dans les views Article et Comment
     * @param string|null $url
     * @param int|null $get
     * @param string|null $start
     * @param $currentPage
     * @param $pages
     */
    public function showPagination(?string $url = null, ?int $get = null, ?string $start = null, $currentPage, $pages){

        ?>
        <nav>
            <ul class="pagination">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                    <a href="<?= $url . $get ?><?= $start . ($currentPage - 1) ?>" class="page-link">Précédente</a>
                </li>
                <?php for($page = 1; $page <= $pages; $page++): ?>
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="<?= $url .  $get ?><?= $start . $page ?>" class="page-link"><?= $page ?></a>
                    </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                    <a href="<?= $url . $get ?><?= $start . ($currentPage + 1) ?>" class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
        <?php
    }
}