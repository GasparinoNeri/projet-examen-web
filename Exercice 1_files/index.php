<?php
session_start();
ob_start();
?>
<h1>Objectifs</h1>
<ul>
    <li>Créer un formulaire d'authentification</li>
    <li>Si l'utilisateur n'est pas connecté, afficher un lien de connexion</li>
    <li>Si l'utilisateur n'est pas connecté, afficher un lien de création d'un nouveau compte</li>
    <li>Si l'utilisateur est connecté, afficher un message de bienvenue</li>
    <li>Si l'utilisateur est connecté, afficher un lien de déconnexion</li>
    <li>Si l'utilisateur est connecté, afficher un lien de listing les utilisateurs</li>
</ul>
<?php if(empty($_SESSION['login'])) { ?>
    <a href="login.php">Connexion</a>
    <br>
    <a href="register.php">Créer un compte</a>
<?php } else { ?>
    Bienvenue <?php echo $_SESSION['login']; ?> !
    <br>
    <a href="logout.php">Déconnexion</a>
    <br>
    <a href="listing.php">Liste des utilisateurs</a>
<?php } ?>
<?php
$content = ob_get_clean();
include '../template.php';
?>
