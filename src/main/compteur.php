<?php
function compteurGlobal(){
	$ini = 1;
	if(file_exists('../generated/compteur_visites.txt')){
			$compteur_f = fopen('../generated/compteur_visites.txt', 'r+');
			$compte = fgets($compteur_f);
	}
	else{
			$compteur_f = fopen('../generated/compteur_visites.txt', 'a+');
			$compte = 1;
			fputs ($compteur_f, $ini);
	}
	if(!isset($_SESSION['compteur_de_visite'])){
			$_SESSION['compteur_de_visite'] = 'visite';
			$compte++;
			fseek($compteur_f, 0);
			fputs($compteur_f, $compte);
	}
	
	fclose($compteur_f);
	
	if($compte ==  0 || $compte == 1){
		echo '<p><strong>'.$compte.'</strong> visite au total</p>';
	}
	else{
		echo '<p><strong>'.$compte.'</strong> visites au total</p>';
	}
}

function personneConnecte(){
	global $bdd;
	$reponse2 = $bdd->query('select count(ip) as nb from personne_connecte where ip="'.$_SERVER['REMOTE_ADDR'].'"');
	
	$dnns = $reponse2->fetch();
	if($dnns['nb']>0)
	{
		$bdd->query('update personne_connecte set timestamp="'.time().'" where ip="'.$_SERVER['REMOTE_ADDR'].'"');
	}
	else
	{
		$bdd->query('insert into personne_connecte (ip, timestamp) values ("'.$_SERVER['REMOTE_ADDR'].'", "'.time().'")');
	}
	$times_m_5mins = time()-(60*5);
	$bdd->query('detete from personne_connecte where timestamp<"'.$times_m_5mins.'"');
	
	$reponse3 = $bdd->query('select count(ip) as nb from personne_connecte');
	$dnns2 = $reponse3->fetch();
	echo '<p>Il y a actuellement <strong>'.$dnns2['nb'].'</strong> connecté</p>';
}

function compteurJournalier(){
	$ini = 1;
	$date = date('d-m-y');
	$hier = date('d-m-y', time() - 3600 * 24); // date de la veille
	if(file_exists('cmpt-'.$hier.'.txt')){
		unlink('cmpt-'.$hier.'.txt'); // supprime le fichier de la veille
	}
	
	/**************************************/
	if(file_exists('../generated/cmpt-'.$date.'.txt')){
		$compteur_f = fopen('../generated/cmpt-'.$date.'.txt', 'r+');
		$compte = fgets($compteur_f);
	}
	else{
		$compteur_f = fopen('../generated/cmpt-'.$date.'.txt', 'a+');
		$compte = 1;
		fputs ($compteur_f, $ini);
	}
	if(!isset($_SESSION['compteur_de_visite_journaliere'])){
		$_SESSION['compteur_de_visite_journaliere'] = 'visite_journaliere';
		$compte++;
		fseek($compteur_f, 0);
		fputs($compteur_f, $compte); // fichier compteur journalier
	}
	
	fclose($compteur_f);
	
	if($compte == 0 || $compte == 1){
		echo '<p><strong>'.$compte.'</strong> visite journalière</p>';
	}
	else{
		echo '<p><strong>'.$compte.'</strong> visites journalières</p>';
	}
}
?>