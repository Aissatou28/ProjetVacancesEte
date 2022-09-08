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
<body>
    <?php 
        include("session.php");
        include("question.php");
        $question= new Question(null,$GLOBALS["pdo"]);

        if(isset($_POST["Ajouter"])){
            
            $question->ajouterQuestion($_POST["idquestion_"],$_POST["question"],$_POST["choix1"],$_POST["choix2"],$_POST["reponse"]);
        }

        if(isset($_POST["Supprimer"])){
            $question->supprimerQuestion($_POST["idquestion"]);
        }

        if(isset($_POST["Modifier"])){
            $question->modifierQuestion($_POST["idUpdate"],$_POST["Uquestion"],$_POST["Uchoix1"],$_POST["Uchoix2"],$_POST["Ureponse"]);
        }
    ?>

    <div>
        <h1>Ajouter une question</h1>
    <form action="" method="post" class="ajoutQuestion">
        <p><input type="number" name="idquestion_" placeholder="N° de la Question" required ></p>
        <p><input type="text" name="question" placeholder="Question" required ></p>
        <p><input type="text" name="choix1" placeholder="Choix1" required ></p>
        <p><input type="text" name="choix2" placeholder="Choix2" required ></p>
        <p><input type="text" name="reponse" placeholder="Bonne réponse" required ></p>
        <p><input type="submit" name="Ajouter" value="Ajouter"></p>
    </form>
    </div>

    <div>
        <h1>Liste des questions</h1>   
    <?php
        $question= new Question(null,$GLOBALS["pdo"]);
        $question->afficherQuestions();
    ?>
    </div>

    <div>
        <h1>Modifier une question</h1>
    <form action="" method="post" class="modifierQuestion">
        <p><input type="number" name="idUpdate" placeholder="N° de la question" required ></p>
        <p><input type="text" name="Uquestion" placeholder="Question" required ></p>
        <p><input type="text" name="Uchoix1" placeholder="Choix1" required ></p>
        <p><input type="text" name="Uchoix2" placeholder="Choix2" required ></p>
        <p><input type="text" name="Ureponse" placeholder="Bonne réponse" required ></p>
        <p><input type="submit" name="Modifier" value="Modifier"></p>
    </form>
    </div>

    <div>
        <h1>Supprimer une question</h1>
    <form action="" method="post" class="supprimerQuestion">
        <p><input type="number" name="idquestion" placeholder="N° de la question" required ></p>
        <p><input type="submit" name="Supprimer" value="Supprimer"></p>
    </form>
    </div>

</body>
</html>