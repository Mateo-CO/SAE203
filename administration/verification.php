<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    // connexion à la base de données
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['SAE203']));
    $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['comunique']));
    
    if ($username !== "SAE203" && $password !== "comunique") {
        $requete = "SELECT count(*) FROM connexion where 
        nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ";
        $exec_requete = mysqli_query($db, $requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if ($count != 0) { // nom d'utilisateur et mot de passe correctes
            $_SESSION['SAE203'] = $username;
            header('Location: principale.php');
        } else {
            header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
            exit(); // arrêter l'exécution du script après la redirection
        }
    } else {
        header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
        exit(); // arrêter l'exécution du script après la redirection
    }
} else {
    header('Location: login.php');
    exit(); // arrêter l'exécution du script après la redirection
}

mysqli_close($db); // fermer la connexion
?>
