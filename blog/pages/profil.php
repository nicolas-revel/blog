<?php
require_once('../app/Autoload.php');
session_start();
if (isset($_SESSION['user'])) {
  $currentUser = $_SESSION['user'];
}
$nameCat = new \blog\app\views\categorie();

if (isset($_POST['envoyer'])) {
  $currentUser->updateUser($_POST['login'], $_POST['password'], $_POST['c_password'], $_POST['email']);
}
?>
<?php $pageTitle = 'MON COMPTE'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>
  <section id="pageInscription">
    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']->getId())) : ?>
      <!-- row -->
      <div id="illuscode">
        <img id="codeRetro" src="../images/profil.png" alt="illustration">
      </div>
      <div id="formProfil">
        <h3 id="title_ins"><span class="bw">M</span><span class="bw">o</span><span class="bw">m</span> <span class="bw">c</span><span class="bw">o</span><span class="bw">m</span><span class="bw">p</span><span class="bw">t</span><span class="bw">e</span></h3>
        <p id="slogan1">Modifie ton profil.</p>
        <br>
        <form id="blogForm" action="profil.php" method="POST">
          <p>Votre login actuel : <?= $currentUser->getLogin() ?></p>
          <div>
            <label for="login">Nouveau login *</label><br>
            <input type="text" name="login" required placeholder="Nom d'utilisateur">
          </div>
          <br>
          <p>Votre email actuel : <?= $currentUser->getEmail() ?></p>
          <div>
            <label for="email">Nouvel e-mail *</label><br>
            <input type="mail" name="email" required placeholder="E-mail">
          </div>
          <br>
          <div>
            <label for="password">Nouveau password *</label><br>
            <input type="password" name="password" required placeholder="Mot de passe">
          </div>
          <br>
          <div>
            <label for="password">Confirmation nouveau password
              *</label><br>
            <input type="password" name="c_password" required placeholder="Confirmation du nouveau mot de passe">
          </div>
          <br>
          <div>
            <button type="submit" class="btn btn-outline-light" name="envoyer">Envoyer
            </button>
          </div>
        </form>
      </div>
    <?php else : ?>
      <div class="errormessage">
        <p>Oups, vous ne devriez pas être sur cette page.</p>
      </div>
      <?php header('refresh:3; url=accueil.php') ?>
    <?php endif; ?>
  </section>

  <?php require_once('../config/footer.php'); ?>
  <?php $pageContent = ob_get_clean(); ?>

  <?php require_once('template.php'); ?>
</main>