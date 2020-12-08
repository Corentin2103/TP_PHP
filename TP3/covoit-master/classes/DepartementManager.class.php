<?php
class DepartementManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($departement){
          $requete = $this->db->prepare(
          'INSERT INTO division (dep_num, dep_nom,vil_num) VALUES (:dep_num, :dep_nom,:vil_num);');

          $requete->bindValue(':dep_num',$departement->getDepNum());
          $requete->bindValue(':dep_nom',$departement->getDepNom());
					$requete->bindValue(':vil_num',$departement->getVilleNum());

          $retour=$requete->execute();
          return $retour;
      }
    public function getAllDep(){
            $listeDep = array();

            $sql = 'select dep_num, dep_nom,vil_num FROM departement';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($departement = $requete->fetch(PDO::FETCH_OBJ))
                $listeDep[] = new Departement($departement);

            $requete->closeCursor();
            return $listeDep;
					}
  
    public function getDepartementNom($dep_num){
      $sql = 'select dep_nom FROM departement WHERE dep_num= "'.$dep_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      return $requete->fetch();
    }
    public function getVilleNumDep($dep_num){
      $sql = 'select vil_num FROM departement WHERE dep_num= "'.$dep_num.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      return $requete->fetch();
    }
}
