<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<title>Article</title>
		<meta charset="utf-8"/>	
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>Article</h1>
		</div>
	</div>
	</header>
	
	<body>
	
		<div class="container">
			<form class="form-horizontal" action="#" method="post">
					<div class="form-group">
							<label>Titre de l'article</label>
							<input type="text" class="form-control" name="titre" value=""/>
					</div>
					<div class="form-group">
						<label>Texte</label>
						<input type="text" class="form-control" name="texte" value=""/>
					</div>
					<div class="form-group">
						<label>Image</label>
						<input type="file" class="form-control" name="image" value=""/>
					</div>					
					<div class="form-group">
						<input class="btn btn-primary" type="submit" name="envoyer" value="Envoyer"/>
					</div>
			</form>		
		</div>
	</body>
	
	
	<footer>
		<a href="./accueil.php">Retour à l'accueil</a>
	</footer>

</html>

<?php
	
	
	if(isset($_POST["titre"]) && isset($_POST["texte"]) && isset($_POST["envoyer"])){
		$titre=$_POST["titre"];
		$texte=$_POST["texte"];
		$personne=$_SESSION['id'];
		$envoyer=$_POST["envoyer"];
		if(!empty($titre) && !empty($texte) && !empty($envoyer)){
		
			try{
	
				$bdd = new PDO('mysql:host=localhost;dbname=projetsi;charset=utf8', 'root', 'root');
				
					$requete="select * from article";
					
					$reponse = $bdd->query($requete);
					
					$trouve=0;
					
					while ($ligne = $reponse->fetch()){
							if($trouve==0 && $ligne['idArticle']==$titre){
								$trouve=1;
								echo("Changer de titre : Article deja existant");
						}
					}
					if($trouve==0){
					
						$image='';
						$ajout = $bdd->prepare("INSERT INTO article (idArticle, texte, idPersonne) VALUES (:idArticle, :texte, :idPersonne)");
						$ajout->bindParam(':idArticle', $titre);
						//$ajout->bindParam(':image', $image);
						$ajout->bindParam(':texte', $texte);
						$ajout->bindParam(':idPersonne', $personne);
						$ajout->execute();
						

						
						echo '<script>alert("Article enregistré");</script>';
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