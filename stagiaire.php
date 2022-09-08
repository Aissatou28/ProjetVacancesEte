<?php
    class Stagiaire{
      
        //Propriétés
        private $IdStagiaire_;
        private $idUtilisateur_;
        private $Nom_;
        private $Prenom_;
        private $Mail_;
        private $Telephone_;
        private $Entreprise_;
        private $bdd_;

        //Méthodes

        public function __construct($IdStagiaire,$bdd){
            $this->IdStagiaire_=$IdStagiaire;
            $this->bdd_=$bdd;
        }

        //Méthodes CRUD pour gestion des stagiaires par l'admin 


        //Méthode pour ajouter un nouveau stagiaire
        public function ajouterStagiaire($nom,$prenom,$mail,$telephone,$entreprise){

            $chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shfl = str_shuffle($chaine);
            $chaine1 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shfl1 = str_shuffle($chaine1);
            $password = substr($shfl,0,8);
            $identifiant = substr($shfl1,0,8);

            $reqCreer="INSERT INTO `utilisateur` (`Identifiant`, `MotDePasse`, `Status`) VALUES ('".$identifiant."','".$password."', '1')";
            $resultat=$GLOBALS["pdo"]->query($reqCreer);
            if($resultat){
                if($resultat->errorCode()=='00000'){
                    echo "Nouvel utilisateur ajouté ";
                }else{
                    echo "Erreur n° ".$resultat->errorCode()." lors de la création d'un nouvel utilisateur";
                }
                }else{
                echo "Erreur dans le format de la requête";
                } 
            $reqSelectUser="SELECT IdUtilisateur FROM utilisateur ORDER BY IdUtilisateur DESC LIMIT 1";
            $resultat1=$GLOBALS["pdo"]->query($reqSelectUser);
            $tab1=$resultat1->fetch();
            $idUser=$tab1["IdUtilisateur"];

            $reqAjout="INSERT INTO `stagiaire` (`IdUtilisateur`,`Nom`, `Prenom`, `Mail`, `Telephone`, `Entreprise`)
                        VALUES ('".$idUser."','".$nom."','".$prenom."','".$mail."','".$telephone."','".$entreprise."')";
            $resultat2=$GLOBALS["pdo"]->query($reqAjout);
            if($resultat){
                if($resultat2->errorCode()=='00000'){
                    echo "Nouveau Stagiaire ".$prenom." enregistré";
                }else{
                    echo "Erreur N° ".$resultat2->errorCode." lors de l'enregistrement";
                }
            }else{
                echo "Erreur dans le format de la requête";
            }
        }

        //Méthode pour afficher la liste des stagiaires 
        public function afficherStagiaires(){ 
            $reqAffichage="SELECT * FROM stagiaire ORDER BY IdStagiaire ASC";
            $resultat=$GLOBALS["pdo"]->query($reqAffichage);
            if($resultat){
                ?>
                <table>
                    <?php
                    while($tab1=$resultat->fetch()){
                        ?>
                            <tr>
                                <td><?php echo $tab1["IdStagiaire"]; ?></td>
                                <td><?php echo $tab1["Nom"]; ?></td>
                                <td><?php echo $tab1["Prenom"]; ?></td>
                                <td><?php echo $tab1["Mail"]; ?></td>
                                <td><?php echo $tab1["Telephone"]; ?></td>
                                <td><?php echo $tab1["Entreprise"]; ?></td>
                            </tr>
                        <?php
                    } 
                        ?>
                     </table>
                <?php    
            }
        }

        //Méthode pour modifier les informations d'un stagiaire 
        public function modifierStagiaire($_IdUpdate,$_nom,$_prenom,$_mail,$_telephone,$_entreprise){
        $reqUpdate="UPDATE stagiaire SET 
        `Nom`='".$_nom."',`Prenom`='".$_prenom."',`Mail`='".$_mail."',`Telephone`='".$_telephone."',`Entreprise`='".$_entreprise."'
        WHERE IdStagiaire='".$_IdUpdate."' ";
        $resultat= $GLOBALS["pdo"]->query($reqUpdate);
        if($resultat){
            if($resultat->errorCode()=='00000'){
                echo "Vous avez modifier le stagiaire ".$_prenom."  ".$_nom." ";
            }else{
                echo "Erreur n° ".$resultat->errorCode()." lors de la modification";
            }
            }else{
            echo "Erreur dans le format de la requête";
        }
        }

        //Méthode pour supprimer un stagiaire 
        public function supprimerStagiaire($num){
            $reqDelete="DELETE FROM `stagiaire` WHERE `IdStagiaire`= '".$num."' ";
            $resultat=$GLOBALS["pdo"]->query($reqDelete);
            if($resultat){
             if($resultat->errorCode()=='00000'){
                 echo "Vous avez supprimer le stagiaire N° ".$num."  ";
             }else{
                 echo "Erreur n° ".$resultat->errorCode()." lors de la suppression";
             }
             }else{
             echo "Erreur dans le format de la requête";
             }
         }

        
    }

        
    
    
    
    
    
?>