<?php
class Etudiant{

private $per_num;
private $dep_num;
private $div_num;

public function __construct($etudiant){
	if (!empty($etudiant))
			 $this->affecte($etudiant);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'per_num': $this->setPersNum($valeur); break;
							case 'dep_num': $this->setDepNum($valeur); break;
							case 'div_num': $this->setdivNum($valeur); break;
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
/*Numero du departement*/
public function getDepNum() {
		    return $this->dep_num;
	  }
public function setDepNum($valeur){
		    $this->dep_num=$valeur;
		}
/*Numero division*/
public function getdivNum() {
		    return $this->div_num;
	  }
public function setdivNum($valeur){
	  		$this->div_num=$valeur;
	  }

}
?>
