<?php
class ParcoursManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($parcours){
          $requete = $this->db->prepare(
          'INSERT INTO parcours (vil_num1, vil_num2,par_km,par_num) VALUES (:vil_num1, :vil_nom2, :par_km, :par_num);');

          $requete->bindValue(':vil_num1',$parcours->getVilleNum1());
          $requete->bindValue(':vil_nom2',$parcours->getVilleNum2());
					$requete->bindValue(':par_km',$parcours->getParKm());
          $requete->bindValue(':par_num',$parcours->getParNum());
          $retour=$requete->execute();
          return $retour;
      }
    public function getAllParcours(){
            $listeParcours = array();

            $sql = 'select v1.vil_nom as vil_nom1 ,v2.vil_nom as vil_nom2,par_km,par_num FROM parcours p, ville v1, ville v2 WHERE p.vil_num1 = v1.vil_num AND p.vil_num2 = v2.vil_num';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
                $listeParcours[] = $parcours;

            $requete->closeCursor();
            return $listeParcours;
					}
    public function getParcoursRentre(){
      $listeParcours = array();
      $compteur =0;
      $sql = 'select vil_num1, vil_num2,par_km,par_num FROM parcours';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($parcours = $requete->fetch(PDO::FETCH_OBJ)){
          $listeParcours[] = new Ville($parcours);
          $compteur = $compteur + 1;
        }
      $requete->closeCursor();
      return $compteur;
    }
}
