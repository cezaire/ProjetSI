<?php
session_start();
require_once('conf.inc.php');
require_once('./captcha/simple-php-captcha.php');

if(!isset($_SESSION['captcha'])){
	$_SESSION['captcha'] = simple_php_captcha();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../style/base.css" rel="stylesheet">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../style/bootstrap/js/bootstrap.min.js"></script>
		<title> Inscription </title>
		<meta charset="utf-8"/>	
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>Inscription</h1>
		</div>
	</div>
	</header>
	
	<body>
	
		<div class="container">
			<form class="form-horizontal" action="#" method="post">
					<div class="row row-centered">
						<div class="form-group col-xs-4 col-centered">
							<label>Identifiant </label>
							<input type="text" class="form-control" name="id" value="" maxlength="8"/>
						</div>
					</div>
					<div class="row row-centered">
						<div class="form-group col-xs-4 col-centered">
							<label>Email </label>
							<input type="text" class="form-control" name="email" value=""/>
						</div>
					</div>
					<div class="row row-centered">
						<div class="form-group col-xs-4 col-centered">
							<label>Mot de Passe </label>
							<input type="password" class="form-control" name="mdp" value="" maxlength="8"/>
						</div>
					</div>
					<div class="row row-centered">
						<div class="form-group  col-xs-4 col-centered">
							<?php
							echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
							?>
						</div>
					</div>
					<div class="row row-centered">
						<div class="form-group  col-xs-4 col-centered">
							<input type="text" class="form-control" name="captcha" value="" required="required"/>
						</div>
					</div>
					<div class="row row-centered">
						<div class="form-group col-xs-4 col-centered">
							<input class="btn btn-primary" type="submit" name="inscription" value="inscription"/>
						</div>
					</div>
					
			</form>		
		</div>
	</body>
	
	
	<footer>
		<a href="./accueil.php">Retour à l'accueil</a>
	</footer>

</html>

<?php
	$captcha = $_SESSION['captcha']['code'];
	
	if(isset($_POST["id"]) && isset($_POST["mdp"]) && isset($_POST["email"]) && isset($_POST["inscription"])){
		$id=$_POST["id"];
		$mdp=$_POST["mdp"];
		$email=$_POST["email"];
		$inscription=$_POST["inscription"];
		$essaiUser=$_POST["captcha"];
		
		if(!empty($id) && !empty($mdp) && !empty($inscription) && !empty($email)){
			//Vérification du captcha
			if($captcha != $essaiUser){
				echo '<script>alert("Captcha Incorrect !");</script>';	
			}
			else{
				try{
		
					$requete="select * from personne";
					
					$reponse = $bdd->query($requete);
					
					$trouve=0;
					
					while ($ligne = $reponse->fetch()){
							if($trouve==0 && $ligne['id']==$id){
								$trouve=1;
								echo("Changer d'Identifiant : Utilisateur deja existant");
						}
					}
					if($trouve==0){
					
						$ajout = $bdd->prepare("INSERT INTO personne (id,email,mdp) VALUES (:id, :email, :mdp)");
						$ajout->bindParam(':id', $id);
						$ajout->bindParam(':email', $email);
						$ajout->bindParam(':mdp', $mdp);
						$ajout->execute();
						
						echo '<script>alert("inscription reussie");
						document.location.href = "./accueil.php"</script>';
					}

				}
				catch (Exception $e){
				
					die('Erreur : ' . $e->getMessage());
				}
			}
		}
		else{
			echo("Un des parametres est vide");
		}
	}
	
	$_SESSION['captcha'] = simple_php_captcha();
?>