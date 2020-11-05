<?php
class Departement{

private $dep_num;
private $dep_nom;
private $vil_num;

public function __construct($departement){
	if (!empty($departement))
			 $this->affecte($departement);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'dep_num': $this->setDepNum($valeur); break;
							case 'dep_nom': $this->setDepNom($valeur); break;
              case 'vil_num': $this->setVilleNum($valeur); break;
					}
			}
	}

/*NUMERO*/
public function getDepNum() {
        return $this->dep_num;
    }
public function setDepNum($valeur){
        $this->dep_num=$valeur;
    }
/*NOM*/
public function getDepNom() {
		    return $this->dep_nom;
	  }
public function setDepNom($valeur){
		    $this->dep_nom=$valeur;
		}
/*NOM*/
public function getVilleNum() {
    		return $this->vil_num;
    }
public function setVilleNum($valeur){
    		$this->vil_num=$valeur;
    }
}
?>
