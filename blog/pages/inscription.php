<?php
require_once('../app/Autoload.php');
session_start();
$user = new \blog\app\models\User();

if (isset($_POST['envoyer'])) {
    $user = new blog\app\controllers\user();
    $checkLogin = $user->checkLoginValidity($_POST['login']);
    $checkPass = $user->checkPassword($_POST['password'], $_POST['confirm_password']);

    if ($checkLogin && $checkPass) {
        $user->insertUser($_POST['login'], $_POST['password'], $_POST['mail']);;
    } elseif (!$checkLogin) {
        $erromessage = new \blog\app\ErrorMessage("Ce nom d'utilisateur est déjà pris, merci d'en choisir un autre");
    } elseif (!$checkPass) {
        $erromessage = new \blog\app\ErrorMessage("Merci de bien confirmer votre mot de passe");
    }
}
?>

<?php $pageTitle = 'INSCRIPTION'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

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
                    <label for="login">Login *</label><br>
                    <input type="text" name="login" required
                           placeholder="Nom d'utilisateur">
                </div>
                <br>
                <div>
                    <label for="mail">E-mail *</label><br>
                    <input type="mail" name="mail" required
                           placeholder="E-mail">
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
                    <button type="submit" class="btn btn-outline-light"
                            name="envoyer">Envoyer
                    </button>
                </div>
                <?php if (isset($erromessage)) : ?>
                    <div class="errormessage">
                        <p><?= $erromessage->getMessage(); ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </section>
</main>

<?php require_once('../config/footer.php'); ?>
<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
