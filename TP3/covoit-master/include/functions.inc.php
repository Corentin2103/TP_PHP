<?php
	function getEnglishDate($date){
		$membres = explode('-', $date);
		$date = $membres[2].'/'.$membres[1].'/'.$membres[0];
		return $date;
	}

	function addJours($date, $nbJours){
		$membres = explode('-', $date);
		$date = $membres[0].'-'.$membres[1].'-'.(intval($membres[2])+$nbJours);
		
		return $date;
	}

?>
