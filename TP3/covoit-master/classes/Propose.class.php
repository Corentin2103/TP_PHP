<?php
class Propose{

private $par_num;
private $per_num;
private $pro_date;
private $pro_time;
private $pro_place;
private $pro_sens;

public function __construct($propose){
	if (!empty($propose))
			 $this->affecte($propose);

}
public function affecte($donnees){
			foreach ($donnees as $attribut => $valeur){
					switch ($attribut){
							case 'par_num': $this->setParNum($valeur); break;
							case 'per_num': $this->setPernum($valeur); break;
							case 'pro_date': $this->setProDate($valeur); break;
							case 'pro_time': $this->setProTime($valeur); break;
							case 'pro_place': $this->setProPlace($valeur); break;
							case 'pro_sens': $this->setProSens($valeur); break;

					}
			}
	}

public function getParNum() {
        return $this->par_num;
    }
public function setParNum($valeur){
        $this->par_num=$valeur;
    }


public function getPernum() {
		    return $this->per_num;
	  }
public function setPernum($valeur){
		    $this->per_num=$valeur;
		}


public function getProDate(){
        return $this->pro_date;
    }
public function setProDate($valeur){
        $this->pro_date = $valeur;
    }


public function getProTime(){
        return $this->pro_time;
    }
public function setProTime($valeur){
        $this->pro_time = $valeur;
    }


public function getProPlace(){
		    return $this->pro_place;
		}
public function setProPlace($valeur){
		    $this->pro_place = $valeur;
		}



public function getProSens(){
				return $this->pro_sens;
		}
public function setProSens($valeur){
				$this->pro_sens = $valeur;
	  }
}
