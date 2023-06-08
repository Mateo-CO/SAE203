<?php 
//Déclaration de la session
session_start();

require_once("../ressources/includes/connexion-bdd.php");

?>
<html>
 <head>
 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href="login.css" media="screen" type="text/css" />
 </head>
 <body>
 <div id="container">
 <!-- zone de connexion -->
 
 <form action="" method="POST">
 <h1>Connexion</h1>
 
 <label><b>Nom d'utilisateur</b></label>
 <input type="text" placeholder="Entrer le nom d'utilisateur" name="user" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

 <input type="submit" name='submit' value='LOGIN' >
 <?php
 if(isset($_POST['submit'])){
 
    $user=$_POST['user'];
    $mdp=$_POST['mdp'];

    $verif_user=$clientMySQL->prepare("SELECT * FROM connexion WHERE utilisateur=? AND mot_de_passe=?");
    $verif_user->execute(array($user,$mdp));

    //Si l'utilisateur existe dans la base de donnée....
    if($verif_user->rowCount()>0){

        // recupération de l'id de l'utilisateur 
        $id=$verif_user->fetch()["id"];
        
        $_SESSION["id"]=$id;

        //Page article
        $redirection="articles/index.php";
        
        // redirection
        header("location:$redirection");
    }else{
        ?>
          <p>Désolé , votre username ou mot de passe est incorrect....</p>
        <?php
    }


 }
 ?>

 </form>
 </div>
 </body>
</html>