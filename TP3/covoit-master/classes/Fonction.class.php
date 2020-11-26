<?php
class Fonction{

private $fon_num;
private $fon_libelle;

public function __construct($fonction){
	if (!empty($fonction))
			 $this->affecte($fonction);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'fon_num': $this->setFonNum($valeur); break;
							case 'fon_libelle': $this->setFonLibelle($valeur); break;
					}
			}
	}

/*NUMERO*/
public function getFonNum() {
        return $this->fon_num;
    }
public function setFonNum($valeur){
        $this->fon_num=$valeur;
    }
/*NOM*/
public function getFonLibelle() {
		    return $this->fon_libelle;
	  }
public function setFonLibelle($valeur){
		    $this->fon_libelle=$valeur;
		}
}
?>
