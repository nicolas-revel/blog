<?php

use App\Controller\AdminController;

require_once('../config/env.php');
require_once('../config/autoload.php');
session_start();

$adminController = new AdminController();

if (empty($_GET['table'])) {
    $_GET['table'] = "users";
    $tableToDisplay = $adminController->getAllUsers();
}

if (isset($_POST['submit'])) {
    $user->updateUserDroit($_POST['droituser'], $_POST['userid']);
}
if (isset($_POST['sendcat'])) {
    $category->insertCat();
}
if (isset($_GET['modifcat'])) {
    $cat = $category->getCategory($_GET['modifcat']);
}
if (isset($_POST['majcat'])) {
    $category->updateCategorie($cat['id']);
}
if (isset($_GET['delUser'])) {
    $user->deleteUser($_GET['delUser']);
}
if (isset($_GET['delArti'])) {
    $article->deletArticle($_GET['delArti']);
}
if (isset($_GET['delCom'])) {
    $comment->deleteComments($_GET['delCom']);
}
if (isset($_GET['delCat'])) {
    $category->deleteCategorie($_GET['delCat']);
}
?>
<?php
$pageTitle = 'ADMIN'; ?>
<?php
ob_start(); ?>
<?php
require_once('../config/header.php') ?>

    <main>
        <?php
        if (isset($_SESSION['user']) && !empty($_SESSION['user']->getId()) && $_SESSION['user']->getIdRight(
            ) === 1337) : ?>
            <section id="pageInscription">
                <div id="formAd">
                    <h2 id="title_blogout3"><span class="bw">A</span><span class="bw">d</span><span
                                class="bw">m</span><span class="bw">i</span><span class="bw">n</span><span
                                class="bw">i</span><span class="bw">s</span><span class="bw">t</span><span
                                class="bw">r</span><span class="bw">a</span><span class="bw">t</span><span
                                class="bw">i</span><span class="bw">o</span><span class="bw">n</span></h2>
                    <form class="formAdmin" action="admin.php<?php
                    if (isset($cat)) : echo "?modifcat={$cat['id']}";
                    endif; ?>" method="post">
                        <div>
                            <label for="newcat">Ajouter une catégorie :</label><br>
                            <input type="text" name="newcat" id="newcat" value="<?php
                            if (isset($_GET['modifcat'])) : echo "{$cat['nom']}";
                            endif; ?>">
                        </div>
                        <br>
                        <?php
                        if (isset($cat)) : ?>
                            <button type="submit" class="btn btn-outline-light" name="majcat" id="majcat">Mettre à
                                jour
                            </button>
                        <?php
                        else : ?>
                            <button type="submit" class="btn btn-outline-light" name="sendcat" id="sendcat">Ajouter
                            </button>
                        <?php
                        endif; ?>
                    </form>

                    <form class="formAdmin" action="admin.php" method="get">
                        <label for="table">Tables :</label><br>
                        <select id="table" name="table">
                            <option value=""></option>
                            <option value="users">Utilisateurs</option>
                            <option value="art">Articles</option>
                            <option value="com">Commentaires</option>
                            <option value="cat">Catégories</option>
                        </select>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-outline-light" value="Filtrer" name="filter" id="filter">
                            Filtrer
                        </button>
                    </form>
                </div>
                <div id="showTable">
                    <div class="tableAdmin">
                        <br>
                        <h2 id="title_table">Liste des utilisateurs</h2>
                        <br>
                        <table id="table_ad">
                            <thead>
                            <?php
                            foreach (
                            $tableToDisplay

                            as $key => $table
                            ) : ?>
                            <?php
                            if ($key === 0) : ?>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Prénom Nom</th>
                                <th>Droits</th>
                                <th>Modifier Droits</th>
                                <th>Supprimer l'utilisateur</th>
                            </tr>
                            </thead>
                            <tbody id="table_body">
                            <?php
                            endif; ?>
                            <tr>
                                <th><?= $table->getId() ?></th>
                                <td><?= $table->getEmail() ?></td>
                                <td><?= $table->getFullname() ?></td>
                                <td><?= $table->getIdRight() ?></td>
                                <td>
                                    <form method='post' action="">
                                        <select name='droituser' id='droituser'>
                                            <option value='1'>Utilisateur</option>
                                            <option value='42'>Modérateur</option>
                                            <option value='1337'>Admin</option>
                                        </select>
                                        <input type='text' id='userid' name='userid' value='{$user->getId()}'
                                               style='display: none'>
                                        <input type='submit' value='Maj Droits' id='submit'
                                               name='submit'>
                                    </form>
                                </td>
                                <td>
                                    <a href='<?= $_SERVER['PHP_SELF'] ?>?delUser=<?= $table->getId() ?>'>Supprimer
                                        l'utilisateur</a>
                                </td>
                            </tr>
                            <?php
                            endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        <?php
        else : ?>
            <div class="errormessage">
                <p>Oups, vous ne devrier pas être sur cette page.</p>
            </div>
            <?php
            header('refresh:3; url=accueil.php') ?>
        <?php
        endif ?>
    </main>

<?php
require_once('../config/footer.php'); ?>
<?php
$pageContent = ob_get_clean(); ?>

<?php
require_once('template.php'); ?>