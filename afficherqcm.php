<?php
session_start();
if(!isset($_SESSION["idQuestion"]))$_SESSION["idQuestion"]=1;
?>

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
        include("user.php");

        $req="SELECT * FROM question WHERE idQuestion='". $_SESSION["idQuestion"] ."' ";    
       
       $resultat=$GLOBALS["pdo"]->query($req);

        while($tab=$resultat->fetch()){
            $_SESSION["idQuestion"]=$tab['idQuestion'];
            $idQuestion=$tab['idQuestion'];
            $questions=$tab['libellé'];
            $choix1=$tab["choix1"];
            $choix2=$tab["choix2"];
            $laReponse=$tab["reponse"];

            ?>
            <div class="div-questions">
            <form action="" method="post" class="form-questions">
            <p><?php echo $questions ?></p>
            <input type="radio" name="choix" value="<?php echo $choix1 ?>" class="choix1">
            <label for="choix1"><?php echo $choix1 ?></label></br>
            <input type="radio" name="choix" value="<?php echo $choix2 ?>" class="choix2">
            <label for="choix2"><?php echo $choix2 ?></label></br> 
            <input type="submit" name="Valider" value="Valider" class="Valider">
            </form>
            </div>

            <?php  
            
        }
          
        //Traitement du formulaire
        if(isset($_POST["Valider"])){
            if(isset($_POST["choix"])){
                $score=0;
                if($_POST["choix"]==$laReponse){
                $score++;
                }
                if(isset($idQuestion)){
                $reqInsertRep="INSERT INTO `reponses` (`IdUtilisateur`,`idQuestion`, `Reponse`) VALUES ('".$_SESSION["idUtilisateur"]."','".$idQuestion."','".$_POST["choix"]."')";
                $resultat1=$GLOBALS["pdo"]->query($reqInsertRep);
                $_SESSION["idQuestion"]++;
                }else{
                    ?><div><?php echo "Vous avez fini l'évaluation!"; ?></div> 
                    <div><?php echo "Votre score est de ".$score." ! "; ?></div><?php
                    if(isset($_POST["Déconnexion"])){
                        $User2= new user(null,null,null,$GLOBALS["pdo"]);
                        $User2->seDéconnecter();
                    }
                    ?>
                    <div class="div-deconnexion">
                    <form action="" method="post" class="form-deconnexion">
                        <input type="submit" name="Déconnexion" value="Déconnexion" >
                    </form>
                    </div>
                    <?php
    
                }
            }else{
                echo "Veuillez cocher une réponse";
            }     
        }

        
        

        ?>

        
       

        
         
   
</body>
</html>

