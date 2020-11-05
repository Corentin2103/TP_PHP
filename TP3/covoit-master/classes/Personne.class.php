<?php
class Personne{

private $per_num;
private $per_nom;
private $per_prenom;
private $per_tel;
private $per_mail;
private $per_login;
private $per_pwd;

public function __construct($personne){
	if (!empty($personne))
			 $this->affecte($personne);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'per_num': $this->setPersNum($valeur); break;
							case 'per_nom': $this->setPersNom($valeur); break;
							case 'per_prenom': $this->setPersPrenom($valeur); break;
							case 'per_tel': $this->setPersTel($valeur); break;
							case 'per_mail': $this->setPersMail($valeur); break;
							case 'per_login': $this->setPersLogin($valeur); break;
							case 'per_pwd': $this->setPersPwd($valeur); break;
					}
			}
	}

/*NUMERO*/
public function getPersNum() {
        return $this->per_num;
    }
public function setPersNum($valeur){
        $this->per_num=$valeur;
    }
/*NOM*/
public function getPersNom() {
		    return $this->per_nom;
	  }
public function setPersNom($valeur){
		    $this->per_nom=$valeur;
		}
/*PRENOM*/
public function getPersPrenom() {
		    return $this->per_prenom;
	  }
public function setPersPrenom($valeur){
	  		$this->per_prenom=$valeur;
	  }
/*TELEPHONE*/
public function getPersTel() {
			  return $this->per_tel;
		}
public function setPersTel($valeur){
			  $this->per_tel=$valeur;
		}
/*MAIL*/
public function getPersMail() {
				return $this->per_mail;
		}
public function setPersMail($valeur){
				$this->per_mail=$valeur;
		}
/*LOGIN*/
public function getPersLogin() {
				return $this->per_login;
		}
public function setPersLogin($valeur){
				$this->per_login=$valeur;
		}
/*PASSWORD*/
public function getPersPwd() {
				return $this->per_pwd;
  	}
public function setPersPwd($valeur){
				$this->per_pwd=sha1(sha1($valeur).SALT);
		}
}
?>
