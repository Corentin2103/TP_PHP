<?php
class Ville{

private $villeNum;
private $villeNom;


public function __construct($ville){
	if (!empty($ville))
			 $this->affecte($ville);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'vil_num': $this->setVilleNum($valeur); break;
							case 'vil_nom': $this->setVilleNom($valeur); break;

					}
			}
	}
public function getVilleNum() {
        return $this->villeNum;
    }
public function setVilleNum($valeur){
        $this->villeNum=$valeur;
    }

public function getVilleNom(){
        return $this->villeNom;
    }
public function setVilleNom($valeur){
        $this->villeNom = $valeur;
    }

}
?>
