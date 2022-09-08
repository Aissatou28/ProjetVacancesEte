<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body >
    <?php
        include("session.php");
        include("user.php");  

        $User1= new User(null,null,null,$GLOBALS["pdo"]);

        //Traitement formulaire de connexion 
        if(isset($_POST["Connexion"])){
            $User1->seConnecter($_POST["login"],$_POST["password"]);
        } else if (isset($_SESSION["idUtilisateur"])){
            $User1->seConnecter(null,null);
        }

        //Traitement formulaire de déconnexion 
        if(isset($_POST["Déconnexion"])){
            $User1->seDéconnecter();
        }
        
        //Affichage des pages selon le statut de l'utilisateur  
        if(isset($_SESSION["Connexion"]) && $_SESSION["Connexion"]==true){
                        
            if($User1->Status()==0){
                echo "Bienvenue sur la page administrateur";
                ?> 
                   <p><a href="admin-questions.php">Gestion des questions</a></p>
                   <p><a href="admin-stagiaires.php">Gestion des stagiaires</a></p>
                <?php
            }else{
                if($User1->Status()==-1){
                echo "Accès interdit";
                }else{
                   echo "Bienvenue ! ";
                   ?> 
                   <p><a href="afficherqcm.php">Commencer l'évaluation</a></p>
                   <?php
                }
            } ?> <div class="div-deconnexion">
                <form action="" method="post" class="form-deconnexion">
                    <input type="submit" name="Déconnexion" value="Déconnexion" >
                </form>
                </div>
            <?php
            $User1->setUserById($_SESSION["idUtilisateur"]);
        }else{
            //echo "Veuillez vous identifier";
            ?> 
            <div class="div-connexion">
                <div class="h1"><h1>Veuillez vous identifier</h1></div>
            <form action="" method="post" class="form-connexion" > 
                <p><input type="text" name="login" placeholder="Identifiant" required></p>
                <p><input type="password" name="password" placeholder="Mot de passe" required></p>
                <p><input type="submit" name="Connexion" value="Connexion" ></p>
            </form>
            </div>
            <?php 
            }
    ?>
</body>
</html>