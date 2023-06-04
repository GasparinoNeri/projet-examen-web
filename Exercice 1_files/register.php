<?php
if(!empty($_POST['login']) and !empty($_POST['password'])) {

    //PDO: PHP Data Objects
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=cours;charset=utf8', 'root', 'password');
    $reponse = $bdd->prepare('SELECT * FROM user WHERE login = :login');
    $reponse->execute(array(':login' => $_POST['login']));
    $user = $reponse->fetch();
    if(!$user) {
        $reponse = $bdd->prepare('INSERT INTO user(login, password) VALUES(:login, :password)');
        $reponse->execute(array(':login' => $_POST['login'], ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)));
        session_start();
        // Vérification des identifiants via la base de données
        $_SESSION['login'] = $_POST['login'];
        header('Location: /exercice7');
        exit();
    }
}
session_start();
ob_start();
?>
<form action="register.php" method="post">
  <div class="mb-3">
    <label for="login" class="form-label">Nom d'utilisateur</label>
    <input type="text" class="form-control" id="login" name="login" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">S'enregistrer</button>
</form>
<?php
$title = "S'enregistrer";
$content = ob_get_clean();
include '../template.php';
?>
