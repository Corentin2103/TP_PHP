<?php
class Parcours{

private $vil_num1;
private $vil_num2;
private $par_num;
private $par_km;


public function __construct($parcours){
	if (!empty($parcours))
			 $this->affecte($parcours);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'vil_num1': $this->setVilleNum1($valeur); break;
							case 'vil_num2': $this->setVilleNum2($valeur); break;
							case 'par_num': $this->setParNum($valeur); break;
							case 'par_km': $this->setParKm($valeur); break;

					}
			}
	}

public function getParNum() {
        return $this->par_num;
    }

public function setParNum($valeur){
        $this->par_num=$valeur;
    }

public function getParKm() {
		    return $this->par_km;
	  }
public function setParKm($valeur){
		    $this->par_km=$valeur;
		}

public function getVilleNum1(){
        return $this->vil_num1;
    }
public function setVilleNum1($valeur){
        $this->vil_num1 = $valeur;
    }
public function getVilleNum2(){
        return $this->vil_num2;
    }
public function setVilleNum2($valeur){
        $this->vil_num2 = $valeur;
    }
}
