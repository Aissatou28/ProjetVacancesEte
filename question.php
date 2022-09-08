<?php 
    class Question{

        //Propriétés 
        private $idQuestion_;
        private $libellé_;
        private $reponse1_;
        private $reponse0_;
        private $bdd_;

        public function __construct($idQuestion,$bdd){
            $this->idQuestion_=$idQuestion;
            $this->bdd_=$bdd;
        }

        //Méthodes CRUD pour gestion des questions par l'admin 

        //Méthodes pour ajouter une question
        public function ajouterQuestion($idQuestion,$libellé,$choix1,$choix2,$reponse){
            $reqAjout="INSERT INTO `question` (`idQuestion`, `libellé`, `choix1`, `choix2`, `reponse`) VALUES ('".$idQuestion."', '".$libellé."', '".$choix1."', '".$choix2."', '".$reponse."');";
            $resultat= $GLOBALS["pdo"]->query($reqAjout);
            if($resultat){
                if($resultat->errorCode()=='00000'){
                    echo "Nouvelle question ".$libellé." enregistré";
                }else{
                    echo "Erreur N° ".$resultat->errorCode." lors de l'enregistrement";
                }
            }else{
                echo "Erreur dans le format de la requête";
            }
        }

        //Méthode pour afficher la liste des questions 
        public function afficherQuestions(){ 
            $reqAffichage="SELECT * FROM question ORDER BY idQuestion ASC";
        $resultat1=$GLOBALS["pdo"]->query($reqAffichage);
        if($resultat1){
            ?>
            <table>
                <?php
                while($tab1=$resultat1->fetch()){
                    ?>
                        
                        <tr>
                            <td><?php echo $tab1["idQuestion"]; ?></td>
                            <td><?php echo $tab1["libellé"]; ?></td>
                            <td><?php echo $tab1["choix1"]; ?></td>
                            <td><?php echo $tab1["choix2"]; ?></td>
                            <td><?php echo $tab1["reponse"]; ?></td>
                         </tr>
                    <?php
                } 
                    ?>
            </table>
            <?php    
        }
        }

        //Méthode pour modifier une question 
        public function modifierQuestion($idUpdate,$question_,$choix1_,$choix2_,$reponse_){
            $reqUpdate="UPDATE `question`
            SET libellé ='".$question_."',
                choix1 ='".$choix1_."',
                choix2 ='".$choix2_."',
                reponse ='".$reponse_."'
            WHERE
                idQuestion = '".$idUpdate."' ";
            
            $resultat=$GLOBALS["pdo"]->query($reqUpdate);
            if($resultat){
                if($resultat->errorCode()=='00000'){
                    echo "Vous avez modifier la question N° ".$idUpdate."  ";
                }else{
                    echo "Erreur n° ".$resultat->errorCode()." lors de la modification";
                }
                }else{
                echo "Erreur dans le format de la requête";
            }
        }

        //Méthode pour supprimer une question
        public function supprimerQuestion($num){
           $reqDelete="DELETE FROM `question` WHERE `idQuestion`= '".$num."' ";
           $resultat2=$GLOBALS["pdo"]->query($reqDelete);
           if($resultat2){
            if($resultat2->errorCode()=='00000'){
                echo "Vous avez supprimer la question N° ".$num."  ";
            }else{
                echo "Erreur n° ".$resultat2->errorCode()." lors de la suppression";
            }
            }else{
            echo "Erreur dans le format de la requête";
            }
        }
    }
?>