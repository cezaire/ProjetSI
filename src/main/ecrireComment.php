<?php
session_start();
require_once('conf.inc.php');
require_once('./captcha/simple-php-captcha.php');
$_SESSION['captcha'] = simple_php_captcha();
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../style/base.css" rel="stylesheet">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../style/bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/popup.js"></script>	
		<title>Votre commentaire</title>
		<meta charset="utf-8"/>	
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>Ecris ton commentaire</h1>
		</div>
	</div>
	</header>
	
	<body>
	
		<div class="container">
			<form class="form" action="" method="post">	
				<div class="row">
					<div class="form-group  col-xs-4">
						<label>Votre nom </label>
						<input type="text" class="form-control" name="nom" value="" required="required"/>
					</div>
				</div>
				<div class="row">
					<div class="form-group  col-xs-12">
						<label>Votre texte </label>
						<textarea rows="5" class="form-control" name="texte" value="" required="required"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group  col-xs-4">
						<?php
						echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
						?>
					</div>
				</div>
				<div class="row">
					<div class="form-group  col-xs-4">
						<input type="text" class="form-control" name="captcha" value="" required="required"/>
					</div>
				</div>
				<div class="row">
					<div class="form-group  col-xs-12">
						<input class="btn btn-primary" type="submit" name="comment" value="Valider"/>
					</div>
				</div>
			</form>
		</div>
	</body>

</html>

<?php
	
	if(isset($_POST["nom"]) && isset($_POST["texte"]) && isset($_POST["comment"])){
		$nom=$_POST["nom"];
		$texte=$_POST["texte"];
		$article=$_GET["idArticle"];
		$valide='non';
		if(!empty($nom) && !empty($texte) && !empty($article)){
		
			try{
				$ajout = $bdd->prepare("INSERT INTO commentaire (auteur, texte, valide, idArticle) VALUES (:nom, :texte, :valide, :idArticle)");
				$ajout->bindParam(':nom', $nom);
				$ajout->bindParam(':texte', $texte);
				$ajout->bindParam(':valide', $valide);
				$ajout->bindParam(':idArticle', $article);
				$ajout->execute();
				
				//echo '<script>alert("comment reussie");</script>';
				//header('Location:https://www.google.fr/?gws_rd=ssl');
				
			

			}
			catch (Exception $e){
			
				die('Erreur : ' . $e->getMessage());
			}
			echo '<script>refresh();</script>';
		}
		else{
			echo("Un des parametres est vide");
		}
	}
	
?>