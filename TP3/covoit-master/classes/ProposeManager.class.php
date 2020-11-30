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


}
