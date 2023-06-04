<?php
session_start(); // On démarre la session AVANT de la détruire
session_unset(); // On détruit les variables de notre session (les données de l'utilisateur)
session_destroy(); // On détruit notre session (le fichier de session)
header("Location: /exercice7"); // On redirige l'utilisateur vers la page d'accueil
exit();
?>