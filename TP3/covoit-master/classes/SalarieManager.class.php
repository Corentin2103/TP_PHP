<?php
class SalarieManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($salarie){
          $requete = $this->db->prepare(
          'INSERT INTO salarie (per_num, sal_telprof,fon_num) VALUES (:per_num, :sal_telprof, :fon_num);');

          $requete->bindValue(':per_num',$salarie->getPersNum());
          $requete->bindValue(':sal_telprof',$salarie->getSalTelProf());
          $requete->bindValue(':fon_num',$salarie->getFonNum());

          $retour=$requete->execute();
          return $retour;
      }
    public function getAllSal(){
            $listeSal = array();

            $sql = 'select per_num, sal_telprof , fon_num FROM salarie';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
                $listeSal[] = new Salarie($salarie);

            $requete->closeCursor();
            return $listeSal;
					}

    public function getSalRentree(){
      $listeSal = array();
      $compteur =0;
        $sql = 'select per_num, sal_telprof , fon_num FROM salarie';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($salarie = $requete->fetch(PDO::FETCH_OBJ)){
          $listeSal[] = new Salarie($salarie);
          $compteur = $compteur + 1;
        }
      $requete->closeCursor();
      return $compteur;
    }

    public function EstPresent($pers_num){
      $sql = 'select per_num FROM salarie WHERE per_num= "'.$pers_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($salarie = $requete->fetch(PDO::FETCH_ASSOC)){
          if($pers_num == $salarie['per_num']){
            return true;
          }
        }
      $requete->closeCursor();

    }

    public function RecupSalarie($pers_num){
      $recupSal = array();
      $sql = 'select sal_telprof,fon_num FROM salarie WHERE per_num= "'.$pers_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      while ($salarie = $requete->fetch(PDO::FETCH_ASSOC)){
          $recupSal[] = $salarie;
        }
        $requete->closeCursor();
        return $recupSal;
    }
}
