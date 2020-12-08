<?php
class ProposeManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($propose){
          $requete = $this->db->prepare(
          'INSERT INTO propose (par_num, per_num,pro_date,pro_time,pro_place,pro_sens) VALUES (:par_num, :per_num, :pro_date, :pro_time,:pro_place,:pro_sens);');

          $requete->bindValue(':par_num',$propose->getParNum());
          $requete->bindValue(':per_num',$propose->getPernum());
					$requete->bindValue(':pro_date',$propose->getProDate());
          $requete->bindValue(':pro_time',$propose->getProTime());
					$requete->bindValue(':pro_place',$propose->getProPlace());
					$requete->bindValue(':pro_sens',$propose->getProSens());
          $retour=$requete->execute();
          return $retour;
      }
      public function getAllVilleDepart(){

        $listeParNum = array();
        $listeVilleNum = array();
        $sql = 'select distinct par_num,pro_sens FROM propose';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($par_num = $requete->fetch(PDO::FETCH_ASSOC)){
          if($par_num["pro_sens"] = 1){
            $sql2 = 'select distinct vil_num2 as vil_num FROM parcours where par_num="'.$par_num["par_num"].'"';
            $requete2 = $this->db->prepare($sql2);
            $requete2->execute();
            while ($vil_num = $requete2->fetch(PDO::FETCH_ASSOC)){
            $listeVilleNum[] = $vil_num;
            }
          }
          if($par_num["pro_sens"] = 0){
            $sql2 = 'select distinct vil_num1 as vil_num FROM parcours where par_num="'.$par_num["par_num"].'"';
            $requete2 = $this->db->prepare($sql2);
            $requete2->execute();
            while ($vil_num = $requete2->fetch(PDO::FETCH_ASSOC)){
            $listeVilleNum[] = $vil_num;
            }
          }

          }
          print_r($listeVilleNum);
        $requete->closeCursor();
        $requete2->closeCursor();
        return $listeVilleNum;
      }

}
