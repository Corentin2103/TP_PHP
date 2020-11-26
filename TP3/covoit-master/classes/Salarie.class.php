<?php
class Salarie{

private $per_num;
private $sal_telprof;
private $fon_num;

public function __construct($salarie){
	if (!empty($salarie))
			 $this->affecte($salarie);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'per_num': $this->setPersNum($valeur); break;
							case 'sal_telprof': $this->setSalTelProf($valeur); break;
							case 'fon_num': $this->setFonNum($valeur); break;
					}
			}
	}

/*Personne NUMERO*/
public function getPersNum() {
        return $this->per_num;
    }
public function setPersNum($valeur){
        $this->per_num=$valeur;
    }
/*Tel*/
public function getSalTelProf() {
		    return $this->sal_telprof;
	  }
public function setSalTelProf($valeur){
		    $this->sal_telprof=$valeur;
		}
/*Fonction numero*/
public function getFonNum() {
				return $this->fon_num;
	  }
public function setFonNum($valeur){
				$this->fon_num=$valeur;
	  }
}
?>
