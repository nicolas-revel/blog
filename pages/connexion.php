<?php

use App\Controller\AuthController;

require_once('../config/env.php');
require_once('../config/autoload.php');
session_start();
$loginController = new AuthController();

if (isset($_POST['submit'])) {
    $loginController->login($_POST['email'], $_POST['password']);
}
?>
<?php
$pageTitle = 'CONNEXION'; ?>
<?php
ob_start(); ?>
<?php
require_once('../config/header.php'); ?>

<main>

    <section id="pageInscription">
        <div id="illusVapo">
            <img id="vapo" src="../images/vapowarve.png"
                 alt="illustration retro">
        </div>

        <div id="formIns">
            <h3 id="title_ins"><span class="bw">C</span><span
                        class="bw">o</span><span class="bw">n</span><span
                        class="bw">n</span><span class="bw">e</span><span
                        class="bw">x</span><span class="bw">i</span><span
                        class="bw">o</span><span class="bw">n</span></h3>
            <p id="slogan1">connecte-toi et donne tons avis!</p>
            <br>
            <form id="blogForm" action="connexion.php" method="POST">
                <br>
                <div>
                    <label for="login">Login *</label><br>
                    <input type="email" name="email" required
                           placeholder="Votre email">
                </div>
                <br>
                <div>
                    <label for="password">Password *</label><br>
                    <input type="password" name="password" required
                           placeholder="Mot de passe">
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-outline-light"
                            name="submit">Envoyer
                    </button>
                </div>
                <?php
                if (isset($errormessage)) : ?>
                    <div class="errormessage">
                        <p><?= $errormessage->getMessage(); ?></p>
                    </div>
                <?php
                endif; ?>
            </form>
        </div>
    </section>
</main>

<?php
require_once('../config/footer.php'); ?>
<?php
$pageContent = ob_get_clean(); ?>
<?php
require_once('template.php'); ?>
