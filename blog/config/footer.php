<footer id="stickyFoot">
        <div id="link_footer">
            <a href="../pages/accueil.php"><img id="logoblogfooter" src="../images/logoblogfooter.png" alt="logo bLogOut"></a>
            <p id="adress">8 RUE D'HOZIER<br>13002 MARSEILLE<br>blogout@gmail.com</p>
        </div>
    <div id="menu_footer1">
        <li class="nav-item">
            <a class="nav-link2 active" aria-current="page" href="../index.php">Home</a>
        </li>
        <?php if(!empty($_SESSION['user']) && $_SESSION['user']->getDroits() == 1): ?>
        <li class="nav-item">
            <a class="nav-link2" href="../pages/profil.php">Profil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link2" href="../pages/articles.php">Voir articles</a>
        </li>
        <?php elseif(!empty($_SESSION['user']) && $_SESSION['user']->getDroits() == 42): ?>
        <li class="nav-item">
            <a class="nav-link2" href="../pages/profil.php">Profil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link2" href="../pages/creer_article.php"> Ecrire article</a>
        </li>
    </div>
        <div id="menu_footer">
            <?php elseif(!empty($_SESSION['user']) && $_SESSION['user']->getDroits() == 1337): ?>
            <li class="nav-item">
                <a class="nav-link2" href="../pages/profil.php">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link2" href="../pages/creer_article.php"> Ecrire article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link2" href="../pages/admin.php">Admin</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link2" href="../pages/inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link2" href="../pages/connexion.php">Connexion</a>
            </li>
        </div>
    <?php endif; ?>
</footer>
