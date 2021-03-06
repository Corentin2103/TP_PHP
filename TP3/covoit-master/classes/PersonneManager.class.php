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

      $sql = 'select distinct per_num, per_nom , per_prenom FROM personne';

      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($personne = $requete->fetch(PDO::FETCH_OBJ)){
        $listePers[] = new Personne($personne);
      }
      $requete->closeCursor();
      return $listePers;
    }

    public function RecupPersNom($pers_num){
      $recupPers = array();

      $sql = 'select per_nom FROM personne where per_num='.$pers_num.'';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      return $requete->fetch();

    }
    public function RecupPersPrenom($pers_num){
      $recupPers = array();

      $sql = 'select per_prenom FROM personne where per_num='.$pers_num.'';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      return $requete->fetch();
    }

    public function RecupPersLogin($pers_num){
      $recupPers = array();
      $sql = 'select per_login FROM personne where per_num='.$pers_num.'';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      return $requete->fetch();
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


    public function RecupPersNum($per_login){

      $sql = 'select per_num FROM personne where per_login="'.$per_login.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();
      return $requete->fetch();
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
    public function EstPresentLogin($per_login){
      $sql = 'select per_login FROM personne WHERE per_login= "'.$per_login.'"';
      $requete = $this->db->prepare($sql);
      $requete->execute();

      while ($personne = $requete->fetch(PDO::FETCH_ASSOC)){
        if($per_login == $personne['per_login']){
          return true;

          $requete->closeCursor();
        }
      }
      return false;
      $requete->closeCursor();

    }
    public function SupprimerPers($num_pers,$personne){

      $sql1 = 'DELETE FROM `avis` WHERE per_num = \''.$num_pers.'\'';
      $requete1 = $this->db->prepare($sql1);
      $requete1->execute();

      $sql2 = 'DELETE FROM `avis` WHERE per_per_num = \''.$num_pers.'\'';
      $requete2 = $this->db->prepare($sql2);
      $requete2->execute();

      $sql3 ='DELETE FROM `propose` WHERE per_num = \''.$num_pers.'\'';
      $requete3 = $this->db->prepare($sql3);
      $requete3->execute();

      if($personne == 1){
        $sql4 ='DELETE FROM `etudiant` WHERE per_num = \''.$num_pers.'\'';
        $requete4 = $this->db->prepare($sql4);
        $requete4->execute();
      }
      if($personne == 0){
        $sql4 ='DELETE FROM `salarie` WHERE per_num = \''.$num_pers.'\'';
        $requete4 = $this->db->prepare($sql4);
        $requete4->execute();
      }

      $sql5 ='DELETE FROM `personne` WHERE per_num = \''.$num_pers.'\'';
      $requete5 = $this->db->prepare($sql5);
      $requete5->execute();


      $requete1->closeCursor();
      $requete2->closeCursor();
      $requete3->closeCursor();
      $requete4->closeCursor();
      $requete5->closeCursor();
      return $requete1;
    }
    public function updatePersonne($personne){
      $sql ='UPDATE personne SET per_nom=:per_nom,per_prenom=:per_prenom,per_tel=:per_tel,per_mail=:per_mail,per_login=:per_login,per_pwd=:per_pwd where per_num= :per_num ';
      $requete = $this->db->prepare($sql);
      $requete->bindValue(':per_num',$personne->getPersNum());
      $requete->bindValue(':per_nom',$personne->getPersNom());
      $requete->bindValue(':per_prenom',$personne->getPersPrenom());
      $requete->bindValue(':per_tel',$personne->getPersTel());
      $requete->bindValue(':per_mail',$personne->getPersMail());
      $requete->bindValue(':per_login',$personne->getPersLogin());
      $requete->bindValue(':per_pwd',$personne->getPersPwd());
      $retour = $requete->execute();
      $requete->closeCursor();
      return $retour;
    }
  }
