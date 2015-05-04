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
	echo '<p><strong>'.$compte.'</strong> visites au total</p>';
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
	echo 'Il y a actuellement <strong>'.$dnns2['nb'].'</strong> connecté';
}

function compteurJournalier(){
	global $bdd;
	//date du jour
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	$jour  = "$day-$month-$year";

	// On efface les IP qui sont "périmées" (date actuelle différente des dates précédentes)
	$bdd->query("DELETE * FROM compteur WHERE date != '$jour'");

	// On effectue une recherche pour savoir si l'IP est déjà enregistrée.
	$bdd->query("SELECT ip FROM compteur WHERE date='$jour'");

	// On vérifie l'ip

	if($ip != '$REMOTE_ADDR')
	{

	// On insère l'ip si elle n'existe pas.
	$bdd->query("INSERT INTO compteur(ip,date) VALUES('$REMOTE_ADDR','$jour')");

	}

	// On récupère la valeur du compteur

	$select = $bdd->query("SELECT ip FROM compteur WHERE date = '$jour'");
	$compteur = $select->rowCount();

	if($compteur == '1' OR $compteur == '0')
	{
	echo "1 visiteur pour aujourd'hui.";
	}
	else
	{
	echo $compteur." visiteurs pour aujourd'hui";
	}




}
?>