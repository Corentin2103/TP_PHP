<?php
class VilleManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($ville){
          $requete = $this->db->prepare(
          'INSERT INTO ville (vil_num, vil_nom) VALUES (:vil_num, :vil_nom);');

          $requete->bindValue(':vil_num',$ville->getVilleNum());
          $requete->bindValue(':vil_nom',$ville->getVilleNom());
          $retour=$requete->execute();
          return $retour;
      }
    public function getAllVille(){
            $listeVille = array();

            $sql = 'select distinct vil_num, vil_nom FROM ville group by vil_nom, vil_num';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($ville = $requete->fetch(PDO::FETCH_OBJ))
                $listeVille[] = new Ville($ville);

            $requete->closeCursor();
            return $listeVille;
					}



    public function getVilleNom($vil_num){
      $sql = 'select vil_nom FROM ville WHERE vil_num= "'.$vil_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      return $requete->fetch();
    }
    public function estPresent($vil_nom){
      $sql ='Select vil_nom from ville';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      while ($ville = $requete->fetch(PDO::FETCH_ASSOC)){
          if($vil_nom == $ville['vil_nom']){
            return true;
            $requete->closeCursor();
          }
        }
        return false;
      $requete->closeCursor();
    }

    public function getVille1Parcours(){
      $listeVille = array();
      $sql = 'select distinct vil_num, vil_nom FROM ville v ,parcours p where p.vil_num1 =v.vil_num
                UNION
              select distinct vil_num, vil_nom FROM ville v ,parcours p where p.vil_num2 =v.vil_num ';
     $requete = $this->db->prepare($sql);
     $requete->execute();
     while ($ville = $requete->fetch(PDO::FETCH_ASSOC))
         $listeVille[] = $ville;

     $requete->closeCursor();
     return $listeVille;
    }

    public function getVille2Parcours($vil_num){
      $listeVille = array();
      $sql = 'select distinct v.vil_num, v.vil_nom FROM ville v ,parcours p where p.vil_num2 =v.vil_num and p.vil_num1 ="'.$vil_num.'"
              UNION
              select distinct v.vil_num, v.vil_nom FROM ville v ,parcours p where p.vil_num1 =v.vil_num and p.vil_num2 ="'.$vil_num.'"';
     $requete = $this->db->prepare($sql);
     $requete->execute();
     while ($ville = $requete->fetch(PDO::FETCH_ASSOC)){
       if($ville["vil_num"] != $vil_num){
         $listeVille[] = $ville;
       }
       }
     $requete->closeCursor();
     return $listeVille;
    }


}
