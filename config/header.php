<?php
require_once('../app/Autoload.php');
$currentUser = $_SESSION['user'];
$nameCat = new \blog\app\views\categorie;
?>
    <header>
        <nav id="navBar" class="navbar navbar-expand-lg navbar-white bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="../pages/accueil.php"><img id="bloglogo" src="../images/logoblog.PNG" alt="logo du blogout"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../pages/accueil.php"><span class="line">|</span> Home</a>
                        </li>
                        <?php if(!empty($_SESSION['user']->getLogin())): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/profil.php"><span class="line">|</span> Profil</a>
                        </li>
                        <?php elseif($_SESSION['user']->getDroits() == 1337): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/creer_article.php"><span class="line">|</span> Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/admin.php"><span class="line">|</span> Admin</a>
                        </li>
                        <?php elseif($_SESSION['user']->getDroits() == 42): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/creer_article.php"><span class="line">|</span> Article</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/inscription.php"><span class="line">|</span> Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/connexion.php"><span class="line">|</span> Connexion</a>
                        </li>
                        <?php endif; ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu dropdown-menu-white dropdown-menu-white" aria-labelledby="navbarDropdown">
                                <?= $nameCat->showNameCategorie(); ?>
                            </ul>
                        </li>
                </div>
            </div>
        </div>
    </nav>
</header>




