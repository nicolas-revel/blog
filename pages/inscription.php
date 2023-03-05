<?php

use App\Controller\AuthController;

require_once('../config/env.php');
require_once('../config/autoload.php');
session_start();

$authController = new AuthController();

if (isset($_POST['submit'])) {
    try {
        $authController->register(
            $_POST['email'],
            $_POST['password'],
            $_POST['confirm_password'],
            $_POST['firstname'],
            $_POST['lastname']
        );
    } catch (Exception $e) {
        $errormessage = $e->getMessage();
    }
}
?>

<?php
$pageTitle = 'INSCRIPTION'; ?>
<?php
ob_start(); ?>
<?php
require_once('../config/header.php'); ?>

<main>
    <section id="pageInscription"><!-- row -->
        <div id="illusPCguy">
            <img id="pcguy" src="../images/pcguy.png" alt="illustration pc guy">
        </div>

        <div id="formIns">
            <h3 id="title_ins"><span class="bw">I</span><span
                        class="bw">n</span><span class="bw">s</span><span
                        class="bw">c</span><span class="bw">r</span><span
                        class="bw">i</span><span class="bw">p</span><span
                        class="bw">t</span><span class="bw">i</span><span
                        class="bw">o</span><span class="bw">n</span></h3>
            <p id="slogan1">Saute le pas et rejoins-nous!</p>
            <br>
            <form id="blogForm" action="inscription.php" method="POST">
                <div>
                    <label for="email">Email *</label><br>
                    <input type="email" name="email" required
                           placeholder="Nom d'utilisateur">
                </div>
                <br>
                <div>
                    <label for="password">Password *</label><br>
                    <input type="password" name="password" required
                           placeholder="Mot de passe">
                </div>
                <br>
                <div>
                    <label for="confirm_password">Confirmation du password
                        *</label><br>
                    <input type="password" name="confirm_password" required
                           placeholder="Mot de passe">
                </div>
                <br>
                <div>
                    <label for="firstname">Prénom *</label><br>
                    <input type="text" name="firstname" required
                           placeholder="Votre prénom">
                </div>
                <br>
                <div>
                    <label for="lastname">Nom *</label><br>
                    <input type="text" name="lastname" required
                           placeholder="Votre nom">
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
                        <p><?= $errormessage; ?></p>
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
