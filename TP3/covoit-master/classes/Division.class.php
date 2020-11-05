<?php
class Division{

private $div_num;
private $div_nom;

public function __construct($division){
	if (!empty($division))
			 $this->affecte($division);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'div_num': $this->setDivNum($valeur); break;
							case 'div_nom': $this->setDivNom($valeur); break;
					}
			}
	}

/*NUMERO*/
public function getDivNum() {
        return $this->div_num;
    }
public function setDivNum($valeur){
        $this->div_num=$valeur;
    }
/*NOM*/
public function getDivNom() {
		    return $this->div_nom;
	  }
public function setDivNom($valeur){
		    $this->div_nom=$valeur;
		}
}
?>
