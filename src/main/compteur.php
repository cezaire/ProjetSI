<?php

function compteurGlobal(){
	if(file_exists('../generated/compteur_visites.txt'))
	{
			$compteur_f = fopen('../generated/compteur_visites.txt', 'r+');
			$compte = fgets($compteur_f);
	}
	else
	{
			$compteur_f = fopen('../generated/compteur_visites.txt', 'a+');
			$compte = 0;
	}
	if(!isset($_SESSION['compteur_de_visite']))
	{
			$_SESSION['compteur_de_visite'] = 'visite';
			$compte++;
			fseek($compteur_f, 0);
			fputs($compteur_f, $compte);
	}
	fclose($compteur_f);
	echo '<p><strong>'.$compte.'</strong> visites</p>';
}
?>