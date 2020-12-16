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

            $sql = 'select v1.vil_nom as vil_nom1 ,v2.vil_nom as vil_nom2,par_km,par_num
            FROM parcours p, ville v1, ville v2 WHERE p.vil_num1 = v1.vil_num AND p.vil_num2 = v2.vil_num AND par_km > 0';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($parcours = $requete->fetch(PDO::FETCH_OBJ)){
              $bool = true;
              foreach ($listeParcours as $infoP){
                  if(($infoP->vil_nom1 == $parcours->vil_nom1 && $infoP->vil_nom2 == $parcours->vil_nom2)
                  ||($infoP->vil_nom1 == $parcours->vil_nom2 && $infoP->vil_nom2 == $parcours->vil_nom1)){
                    $bool = false;
                }
              }
              if($bool){
                $listeParcours[] = $parcours;
              }
            }

            $requete->closeCursor();
            return $listeParcours;
					}


    public function getSens($vil_num1,$vil_num2){
      $sql = 'select distinct vil_num1,vil_num2 FROM parcours WHERE vil_num1= "'.$vil_num1.'" or vil_num2="'.$vil_num1.'"';
      $sql2 = 'select distinct vil_num1,vil_num2 FROM parcours WHERE vil_num1= "'.$vil_num2.'" or vil_num2="'.$vil_num2.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      $requete2 = $this->db->prepare($sql2);
      $requete2->execute();
      while ($ville = $requete->fetch(PDO::FETCH_ASSOC)){
          if($vil_num1 == $ville['vil_num1'] && $vil_num2 == $ville['vil_num2']){
            return 0;
            $requete->closeCursor();
          }
          if($vil_num1 == $ville['vil_num2'] && $vil_num2 == $ville['vil_num1']){
            return 1;
            $requete2->closeCursor();
          }
        }
        while ($ville2 = $requete2->fetch(PDO::FETCH_ASSOC)){
          if($vil_num1 == $ville['vil_num1'] && $vil_num2 == $ville['vil_num2']){
            return 0;
            $requete->closeCursor();
          }
            if($vil_num1 == $ville['vil_num2'] && $vil_num2 == $ville['vil_num1']){
              return 1;
              $requete2->closeCursor();
            }
          }
    }

    public function getParcours($vil_num1,$vil_num2,$pro_sens){
      if($pro_sens == 0){
          $sql = 'select distinct par_num FROM parcours WHERE vil_num1="'.$vil_num1.'" and vil_num2="'.$vil_num2.'"';
      }
      if($pro_sens == 1){
          $sql = 'select distinct par_num FROM parcours WHERE vil_num2= "'.$vil_num1.'" and vil_num1="'.$vil_num2.'"';
      }
      $requete = $this->db->prepare($sql);
      $requete->execute();
      return $requete->fetch();
    }


    public function estPresent($vil_num1,$vil_num2){
      $sql ='select distinct par_num FROM parcours WHERE vil_num1="'.$vil_num1.'" and vil_num2="'.$vil_num2.'"';
      $sql2 = 'select distinct par_num FROM parcours WHERE vil_num2= "'.$vil_num1.'" and vil_num1="'.$vil_num2.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      while ($par_num = $requete->fetch(PDO::FETCH_ASSOC)){
          if(is_null($par_num)){
            return false;
            $requete->closeCursor();
          }
        }
        return true;
      $requete->closeCursor();
    }
}
