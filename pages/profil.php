<?php
require_once ('../app/Autoload.php');
session_start();


$currentUser = $_SESSION['user'];
$nameCat = new \blog\app\views\categorie();
if (isset($_POST['submit'])) {

    $currentUser->updateUser($_POST['login'], $_POST['password'], $_POST['c_password'], $_POST['email']);
}
?>
<?php $pageTitle = 'MON COMPTE'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>

    <section id="pageInscription"><!-- row -->
        <div id="illuscode">
            <img id="codeRetro" src="../images/profil.png" alt="illustration">
        </div>

        <div id="formIns">
            <h3 id="title_ins"><span class="bw">M</span><span class="bw">o</span><span class="bw">m</span> <span class="bw">c</span><span class="bw">o</span><span class="bw">m</span><span class="bw">p</span><span class="bw">t</span><span class="bw">e</span></h3>
            <p id="slogan1">Modifie ton profil.</p>
            <br>
            <form id="blogForm" action="profil.php" method="POST">
                <div>
                    <label for="login">Login *</label><br>
                    <input type="text" name="login" required placeholder="Nom d'utilisateur">
                </div>
                <br>
                <div>
                    <label for="mail">E-mail *</label><br>
                    <input type="mail" name="mail" required placeholder="E-mail">
                </div>
                <br>
                <div>
                    <label for="password">password *</label><br>
                    <input type="password" name="password" required placeholder="Mot de passe">
                </div>
                <br>
                <div>
                    <button type="button" class="btn btn-outline-light" name="envoyer">Envoyer</button>
                </div>
            </form>
        </div>
    </section>

    <?php require_once('../config/footer.php'); ?>
    <?php $pageContent = ob_get_clean(); ?>

    <?php require_once('template.php'); ?>
