<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Admin</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php include("stagiaire.php");
          include("session.php");
        $stagiaire1= new Stagiaire(null,$GLOBALS["pdo"]);

        //traitement formulaire ajout stgaiaire
        if(isset($_POST["AjouterStagiaire"])){
            $stagiaire1->ajouterStagiaire($_POST["nom"],$_POST["prenom"],$_POST["email"],$_POST["telephone"],$_POST["entreprise"]);
            //$stagiaire1->creerUtilisateur();
        }

        //Traitement formulaire modification stagiaire
        if(isset($_POST["ModifierStagiaire"])){
            $stagiaire1->modifierStagiaire($_POST["_IdUpdate"],$_POST["_nom"],$_POST["_prenom"],$_POST["_email"],$_POST["_telephone"],$_POST["_entreprise"]);
        }

        //Traitement formulaire suppression stagiaire
        if(isset($_POST["Supprimer"])){
            $stagiaire1->supprimerStagiaire($_POST["idstagiaire"]);
        }
    ?>
     <div>
        <!--Formulaire ajout stagiaire -->
        <h1>Ajouter un nouveau stagiaire</h1>
        <form action="" method="post" calss="ajoutStagiaire" >
            <p><input type="text" name="nom" placeholder="NOM" required ></p>
            <p><input type="text" name="prenom" placeholder="Prenom" required></p>
            <p><input type="email" name="email" placeholder="Email" required></p>
            <p><input type="tel" name="telephone" placeholder="N° de téléphone" required ></p>
            <p><input type="text" name="entreprise" placeholder="Entreprise" required></p>
            <p><input type="submit" name="AjouterStagiaire" value="Ajouter"></p>
        </form>
     </div>

     <div>
        <h1>Liste des stagiaires</h1>   
    <?php
        $stagiaire= new Stagiaire  (null,$GLOBALS["pdo"]);
        $stagiaire->afficherStagiaires();
    ?>
    </div>

    <div>
        <!--Formulaire modification stagiaire -->
        <h1>Modifier les informations d'un stagiaire</h1>
        <form action="" method="post" class="updateStagiaires" >
            <p><input type="number" name="_IdUpdate" placeholder="N° du Stagiaire"  ></p>
            <p><input type="text" name="_nom" placeholder="NOM" required ></p>
            <p><input type="text" name="_prenom" placeholder="Prenom" required ></p>
            <p><input type="email" name="_email" placeholder="Email" required ></p>
            <p><input type="tel" name="_telephone" placeholder="N° de téléphone" required ></p>
            <p><input type="text" name="_entreprise" placeholder="Entreprise" required ></p>
            <p><input type="submit" name="ModifierStagiaire" value="Modifier" ></p>
        </form>
     </div>

     <div>
        <h1>Supprimer un stagiaire</h1>
    <form action="" method="post" class="supprimerStagiaire">
        <p><input type="number" name="idstagiaire" placeholder="N° du stagiaire" required ></p>
        <p><input type="submit" name="Supprimer" value="Supprimer"></p>
    </form>
    </div>
</body>
</html>