<?php
session_start();

require_once('../app/Autoload.php');

$user = new \blog\app\controllers\User();
$nameCat = new \blog\app\views\categorie();
if (isset($_POST['envoyer'])) {
    $_SESSION['user'] = $user->connectUser($_POST['login'], $_POST['password']);
}
?>
<?php $pageTitle = 'CONNEXION'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>

    <section id="pageInscription"><!-- row -->
        <div id="illusVapo">
            <img id="vapo" src="../images/vapowarve.png" alt="illustration retro">
        </div>

    <div id="formIns">
        <h3 id="title_ins"><span class="bw">C</span><span class="bw">o</span><span class="bw">n</span><span class="bw">n</span><span class="bw">e</span><span class="bw">x</span><span class="bw">i</span><span class="bw">o</span><span class="bw">n</span></h3>
        <p id="slogan1">connecte-toi et donne tons avis!</p>
        <br>
<form id="blogForm" action="connexion.php" method="POST">
    <br>
    <div>
        <label for="login">Login *</label><br>
        <input type="text" name="login" required placeholder="Nom d'utilisateur">
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
</main>

<?php require_once('../config/footer.php'); ?>
<?php $pageContent = ob_get_clean(); ?>
<?php require_once('template.php'); ?>
