<?php
class EtudiantManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($etudiant){
          $requete = $this->db->prepare(
          'INSERT INTO etudiant (per_num, dep_num,div_num) VALUES (:per_num, :dep_num, :div_num);');

          $requete->bindValue(':per_num',$etudiant->getPersNum());
          $requete->bindValue(':dep_num',$etudiant->getDepNum());
          $requete->bindValue(':div_num',$etudiant->getDivNum());

          $retour=$requete->execute();
          return $retour;
      }
    public function getAllEtu(){
            $listeEtu = array();

            $sql = 'select per_num, dep_num , div_num FROM etudiant';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
                $listeEtu[] = new Etudiant($etudiant);

            $requete->closeCursor();
            return $listeEtu;
					}
    public function getEtuRentree(){
      $listeEtu = array();
      $compteur =0;
      $sql = 'select per_num, dep_num , div_num FROM etudiant';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($etudiant = $requete->fetch(PDO::FETCH_OBJ)){
          $listeEtu[] = new Etudiant($etudiant);
          $compteur = $compteur + 1;
        }
      $requete->closeCursor();
      return $compteur;
    }


    public function EstPresent($pers_num){
      $sql = 'select per_num FROM etudiant WHERE per_num= "'.$pers_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)){
          if($pers_num == $etudiant['per_num']){
            return true;
            $requete->closeCursor();
          }
        }
        return false;
      $requete->closeCursor();

    }
    public function RecupEtudiant($pers_num){

      $sql = 'select dep_num FROM etudiant WHERE per_num= "'.$pers_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      return $requete->fetch();
    }
    public function RecupSalarie($pers_num){
      $recupEtu = array();
      $sql = 'select dep_num FROM etudiant WHERE per_num= "'.$pers_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      while ($etudiant = $requete->fetch(PDO::FETCH_ASSOC)){
          $recupEtu[] = $etudiant;
        }
        $requete->closeCursor();
        return $recupEtu;
    }


}
