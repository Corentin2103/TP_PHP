<?php
class DivisionManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($division){
          $requete = $this->db->prepare(
          'INSERT INTO division (div_num, div_nom) VALUES (:div_num, :div_nom);');

          $requete->bindValue(':div_num',$division->getDivNum());
          $requete->bindValue(':div_nom',$division->getDivNom());

          $retour=$requete->execute();
          return $retour;
      }
    public function getAllDiv(){
            $listeDiv = array();

            $sql = 'select div_num,div_nom FROM division';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($division = $requete->fetch(PDO::FETCH_OBJ))
                $listeDiv[] = new Division($division);

            $requete->closeCursor();
            return $listeDiv;
					}
    public function getDivRentre(){
      $listeDiv = array();
      $compteur =0;
  		$sql = 'select div_num,div_nom FROM division';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($division = $requete->fetch(PDO::FETCH_OBJ)){
          $listeDiv[] = new Ville($division);
          $compteur = $compteur + 1;
        }
      $requete->closeCursor();
      return $compteur;
    }
}
