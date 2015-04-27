<!DOCTYPE html>
<html>

	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<title> PAGE CONNEXION </title>  
		<meta charset="utf-8"/>
	</head>

	<body>
	<header>
		<div class='page-header'>
			<div class='container'>
				<h1 style='text-align: center;'>PAGE CONNEXION</h1>
			</div>
		</div>
	</header>

	</body>



<?php
session_start();
echo showForm();

if(isset($_POST['id']) && isset($_POST['mdp']) && isset($_POST['connexion'])){
	$id = $_POST['id']; 
	$mdp = $_POST['mdp']; 
	$result=false; 
	
	if(!empty($id) && !empty($mdp)){
		
		try{
			
			$bdd = new PDO('mysql:host=localhost;dbname=projetsi;charset=utf8', 'root', 'root');
		
				$requete="select * from user where id='".$id."' AND mdp='".$mdp."'";
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
$r.='<div class="form-group"><label>Identifiant</label><input class="form-control" type="text" name="id"/></div>'; 
$r.='<div class="form-group"><label>Mot de Passe</label><input class="form-control" type="password" name="mdp"/></div>'; 
$r.='<div class="form-group"><input class="btn btn-primary" id="submit" type="submit" name="connexion" value="connexion"/></div>'; 
$r.='<div class="form-group"><input class="btn btn-primary" id="reset" type="reset" name="reset" value="reset"/></div>';
$r.='</form></div>'; 

return $r;

}
?>

	<footer>
		<a href="./accueil.php">Retour à l'accueil</a>
	</footer>

</html>