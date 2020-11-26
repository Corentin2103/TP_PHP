<?php
class PersonneManager{
  private $dbo;

		public function __construct($db){
			$this->db = $db;
		}
    public function add($personne){

          $requete = $this->db->prepare(
          'INSERT INTO personne (per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd) VALUES (:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd);');

          $requete->bindValue(':per_nom',$personne->getPersNom());
          $requete->bindValue(':per_prenom',$personne->getPersPrenom());
          $requete->bindValue(':per_tel',$personne->getPersTel());
          $requete->bindValue(':per_mail',$personne->getPersMail());
          $requete->bindValue(':per_login',$personne->getPersLogin());
          $requete->bindValue(':per_pwd',$personne->getPersPwd());
          $retour=$requete->execute();
          $num = $this->db->lastInsertID();
          return $num;
      }
    public function getAllPers(){
            $listePers = array();

            $sql = 'select per_num, per_nom , per_prenom FROM personne';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ)){
                $listePers[] = new Personne($personne);
              }
            $requete->closeCursor();
            return $listePers;
					}
    public function getPersRentree(){
      $listePers = array();
      $compteur =0;
      $sql = 'select per_num, per_nom , per_prenom FROM personne';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($personne = $requete->fetch(PDO::FETCH_OBJ)){
          $listePers[] = new Personne($personne);
          $compteur = $compteur + 1;
        }
      $requete->closeCursor();
      return $compteur;
    }

    public function RecupPers($pers_num){
        $recupPers = array();
        $sql = 'select per_prenom,per_nom,per_mail,per_tel FROM personne where per_num="'.$pers_num.'"';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while ($personne = $requete->fetch(PDO::FETCH_ASSOC)){
            $recupPers[] = $personne;
          }
        $requete->closeCursor();
        return $recupPers;

    }
    public function EstPresent($per_login,$per_pwd){
      $sql = 'select per_login,per_pwd FROM personne WHERE per_login= "'.$per_login.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($personne = $requete->fetch(PDO::FETCH_ASSOC)){
          if($per_login == $personne['per_login'] && sha1(sha1($per_pwd).SALT) ==$personne['per_pwd']){
            return true;

            $requete->closeCursor();
          }
        }
        return false;
      $requete->closeCursor();

    }
}
