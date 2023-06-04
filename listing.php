<?php
session_start();
/* Vérifier si l'utilisateur a un login dans sa session. Si pas, on le redirige vers la page d'accueil */
if(empty($_SESSION['login'])){
    header('Location: /exercice7');
    exit();
}

//PDO: PHP Data Objects
$bdd = new PDO('mysql:host=127.0.0.1;dbname=cours;charset=utf8', 'root', 'password');
$reponse = $bdd->query('SELECT * FROM user');
$users = $reponse->fetchAll();
$reponse->closeCursor(); // Termine le traitement de la requête
ob_start();
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom d'utilisateur</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($users as $user): ?>
    <tr>
      <th scope="row"><?php echo $user['id'] ?></th>
      <td><?php echo $user['login'] ?></td>
      <td>
        <a class="btn btn-warning" href="edit.php?id=<?php echo $user['id'] ?>" role="button">Modifier</a>
        <a class="btn btn-danger" href="delete.php?id=<?php echo $user['id'] ?>" role="button">Supprimer</a>
      </td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php
$title = "Liste des utilisateurs";
$content = ob_get_clean();
include '../template.php';
?>