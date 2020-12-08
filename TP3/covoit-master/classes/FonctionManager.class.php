<?php
class FonctionManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($fonction){
          $requete = $this->db->prepare(
          'INSERT INTO fonction (fon_num, fon_libelle) VALUES (:fon_num, :fon_libelle);');

          $requete->bindValue(':fon_num',$fonction->getFonNum());
          $requete->bindValue(':fon_libelle',$fonction->getFonLibelle());

          $retour=$requete->execute();
          return $retour;
      }
    public function getAllFonction(){
            $listeFonction = array();

            $sql = 'select fon_num,fon_libelle FROM fonction';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($fonction = $requete->fetch(PDO::FETCH_OBJ))
                $listeFonction[] = new Fonction($fonction);

            $requete->closeCursor();
            return $listeFonction;
					}
    
    public function getRecupFonctionLibelle($fon_num){

      $compteur =0;
  		$sql = 'select fon_libelle FROM fonction where fon_num= "'.$fon_num.'"';

      $requete = $this->db->prepare($sql);
      $requete->execute();
        return $requete->fetch();
    }
}
