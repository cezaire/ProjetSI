<!DOCTYPE html>
<html>

	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../style/base.css" rel="stylesheet">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../style/bootstrap/js/bootstrap.min.js"></script>
		<title> PAGE CONNEXION </title>  
		<meta charset="utf-8"/>
	</head>

	<body>
	<header>
		<div class='page-header'>
			<div class='container'>
				<h1 style='text-align: center;'>Connecte toi</h1>
			</div>
		</div>
	</header>

	</body>



<?php
session_start();
require_once('conf.inc.php');
echo showForm();

if(isset($_POST['id']) && isset($_POST['mdp']) && isset($_POST['connexion'])){
	$id = $_POST['id']; 
	$mdp = $_POST['mdp']; 
	$result=false; 
	
	if(!empty($id) && !empty($mdp)){
		
		try{
		
			$requete="select * from personne where id='".$id."' AND mdp='".$mdp."'";
			$reponse = $bdd->query($requete);
			
			$verif=$reponse->fetch();
			
			if($verif){
				$_SESSION['id']=$id;
				$_SESSION['mdp']=$mdp;
				header('Location:./accueil.php');
			}
			else{
				echo 'Identifiant ou Mot de Passe incorrects';
			}
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
	}
}

//echo '<a href="Recapitulatif.php"> Retour au recapitulatif  </a>';

function showForm(){

$r='<div class="container">'; 
$r.='<form class="form-horizontal" method="post" action="">'; 
$r.='<div class="row row-centered"><div class="form-group col-xs-4 col-centered"><label>Identifiant</label><input class="form-control" type="text" name="id"/></div></div>'; 
$r.='<div class="row row-centered"><div class="form-group col-xs-4 col-centered"><label>Mot de Passe</label><input class="form-control" type="password" name="mdp"/></div></div>'; 
$r.='<div class="row row-centered"><div class="form-group col-xs-4 col-centered"><input class="btn btn-primary" id="submit" type="submit" name="connexion" value="connexion"/></div></div>'; 
$r.='<div class="row row-centered"><div class="form-group col-xs-4 col-centered"><input class="btn btn-primary" id="reset" type="reset" name="reset" value="reset"/></div></div>';
$r.='</form></div>'; 

return $r;

}
?>

	<footer>
		<a href="./accueil.php">Retour à l'accueil</a>
	</footer>

</html>