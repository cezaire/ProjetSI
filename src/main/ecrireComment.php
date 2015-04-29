<?php
session_start();
require_once('conf.inc.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../style/base.css" rel="stylesheet">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../style/bootstrap/js/bootstrap.min.js"></script>
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
			<form class="form" action="#" method="post">	
				<div class="form-group  col-xs-4">
					<label>Votre nom </label>
					<input type="text" class="form-control" name="nom" value=""/>
				</div>
				<div class="form-group  col-xs-12">
					<label>Votre texte </label>
					<textarea rows="5" class="form-control" name="texte" value=""></textarea>
				</div>
				<div class="form-group  col-xs-12">
					<input class="btn btn-primary" type="submit" name="comment" value="Valider"/>
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
		if(!empty($nom) && !empty($texte) && !empty($article)){
		
			try{
	
				$requete="select * from commentaire";
				
				$reponse = $bdd->query($requete);
				
				$trouve=0;
				
				while ($ligne = $reponse->fetch()){
						if($trouve==0 && $ligne['nom']==$nom){
							$trouve=1;
							echo("Changer d'Identifiant : Utilisateur deja existant");
					}
				}
				if($trouve==0){
				
					$ajout = $bdd->prepare("INSERT INTO commentaire (auteur, texte, idArticle) VALUES (:nom, :texte, :idArticle)");
					$ajout->bindParam(':nom', $nom);
					$ajout->bindParam(':texte', $texte);
					$ajout->bindParam(':idArticle', $article);
					$ajout->execute();
					
					echo '<script>alert("comment reussie");</script>';
					//header('Location:https://www.google.fr/?gws_rd=ssl');
				}

			}
			catch (Exception $e){
			
				die('Erreur : ' . $e->getMessage());
			}
		}
		else{
			echo("Un des parametres est vide");
		}
	}
?>