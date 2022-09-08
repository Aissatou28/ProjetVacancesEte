<?php 
    class User{

        //Méthodes
        private $IdUtilisateur_;
        private $Identifiant_;
        private $Status_=1;
        private $bdd_;

        public function __construct($id,$ident,$status,$bdd){
        $this->IdUtilisateur_=$id;
        $this->bdd_ = $bdd;
        $this->Identifiant_ = $ident;
        $this->Status_ = $status;
        }

        public function seConnecter($identifiant,$pass){
            if(!isset($_SESSION["idUtilisateur"])){
            $reqConnexion="SELECT * FROM `utilisateur`
            WHERE `Identifiant`='".$identifiant."'
            AND `MotDePasse`='".$pass."'";
            }else {
                $reqConnexion="SELECT * FROM `utilisateur`
            WHERE `utilisateur`.`IdUtilisateur`='".$_SESSION["idUtilisateur"]."'";
            }   
            $resultat=$this->bdd_->query($reqConnexion);

            if($resultat->rowCount()>0){   
                $tab=$resultat->fetch(); 
                $_SESSION["Connexion"]=true;
                $_SESSION["idUtilisateur"]=$tab["IdUtilisateur"];
                

                $this->Identifiant_=$tab["Identifiant"];
                $this->Status_=$tab["Status"];
                $this->IdUtilisateur_=$tab["IdUtilisateur"];

                return true;
                echo "Vous êtes connecté";
            }else{
                echo "Veuillez vérifier les informations saisies";
                session_destroy();
                session_unset();
                return false;
            }
        }

        public function seDéconnecter(){
            session_unset();
            session_destroy();
        }

        public function setUserById($Id){
            $req = "SELECT * FROM `utilisateur` 
            WHERE `IdUtilisateur` = '".$Id."'";
            $resultat = $this->bdd_->query($req);
            if ($tab = $resultat->fetch()){
                $this->Identifiant_ = $tab['Identifiant'];
                $this->IdUtilisateur_ = $tab['IdUtilisateur'];
                $this->Status_ = $tab['Status'];
            }
         } 

        public function getId(){
            return $this->IdUtilisateur_;
        }

        public function Status(){
            return $this->Status_;
        }

        
    }
?>