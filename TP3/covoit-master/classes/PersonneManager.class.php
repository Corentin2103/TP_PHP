<?php
class PersonneManger{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($personne){
          $requete = $this->db->prepare(
          'INSERT INTO ville (vil_num, vil_nom) VALUES (:vil_num, :vil_nom);');

          $requete->bindValue(':vil_num',$personne->getVilleNum());
          $requete->bindValue(':vil_nom',$personne->getVilleNom());
          $retour=$requete->execute();
          return $retour;
      }
    public function getAllVille(){
            $listeVille = array();

            $sql = 'select vil_num, vil_nom FROM ville';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($ville = $requete->fetch(PDO::FETCH_OBJ))
                $listeVille[] = new Ville($ville);

            $requete->closeCursor();
            return $listeVille;
					}
    public function getVilleRentree(){
      $listeVille = array();
      $compteur =0;
      $sql = 'select vil_num, vil_nom FROM ville';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($ville = $requete->fetch(PDO::FETCH_OBJ)){
          $listeVille[] = new Ville($ville);
          $compteur = $compteur + 1;
        }
      $requete->closeCursor();
      return $compteur;
    }
}
