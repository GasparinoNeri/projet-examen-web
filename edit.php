<?php
session_start();
/* Vérifier si l'utilisateur a un login dans sa session. Si pas, on le redirige vers la page d'accueil */
if(empty($_SESSION['login'])){
    header('Location: /exercice7');
    exit();
}
if(!empty($_POST['id']) and !empty($_POST['login']) and !empty($_POST['password'])) {

    //PDO: PHP Data Objects
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=cours;charset=utf8', 'root', 'password');
    $reponse = $bdd->prepare('SELECT * FROM user WHERE id = :id');
    $reponse->execute(array(':id' => $_POST['id']));
    if($reponse->fetch()) {
        $reponse = $bdd->prepare('SELECT * FROM user WHERE login = :login AND id != :id');
        $reponse->execute(array(':login' => $_POST['login'], ':id' => $_POST['id']));
        if(!$reponse->fetch()) {
            $reponse = $bdd->prepare('UPDATE user SET login = :login, password = :password WHERE id = :id');
            $reponse->execute(array(':login' => $_POST['login'], ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT), ':id' => $_POST['id']));
            header('Location: listing.php');
            exit();
        } else {
            header('Location: edit.php?id='.$_POST['id']);
            exit();
        }
    }
} else if(!empty($_GET['id'])){
    //PDO: PHP Data Objects
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=cours;charset=utf8', 'root', 'password');
    $reponse = $bdd->prepare('SELECT * FROM user WHERE id = :id');
    $reponse->execute(array(':id' => $_GET['id']));
    $user = $reponse->fetch();
}
ob_start();
?>
<form action="edit.php" method="post">
  <input type="hidden" name="id" value="<?php echo $user['id'] ?? '' ?>">
  <div class="mb-3">
    <label for="login" class="form-label">Nom d'utilisateur</label>
    <input type="text" class="form-control" id="login" name="login" value="<?php echo $user['login'] ?? '' ?>" required>
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
