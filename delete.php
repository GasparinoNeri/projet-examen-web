<?php
session_start();
/* Vérifier si l'utilisateur a un login dans sa session. Si pas, on le redirige vers la page d'accueil */
if(empty($_SESSION['login'])){
    header('Location: /exercice7');
    exit();
}
if(!empty($_GET['id'])){
    //PDO: PHP Data Objects
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=cours;charset=utf8', 'root', 'password');
    $reponse = $bdd->prepare('DELETE FROM user WHERE id = :id');
    $reponse->execute(array(':id' => $_GET['id']));
}
header('Location: listing.php');
exit();
