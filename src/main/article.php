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
		<title>Article</title>
		<meta charset="utf-8"/>	
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>Ecris ton article</h1>
		</div>
	</div>
	</header>
	
	<body>
	
		<div class="container">
			<form class="form-horizontal centered" enctype="multipart/form-data" action="#" method="post">
				<div class="row">
					<div class="form-group  col-xs-4">
							<label>Titre de l'article</label>
							<input type="text" class="form-control" name="titre" value=""/>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12">
						<label>Texte</label>
						<textarea rows="10" class="form-control" name="texte" value=""></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-6">
						<label>Image</label>
						<input type="file" class="form-control" name="image" value=""/>
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
					<div class="form-group  col-xs-2">
						<input type="text" class="form-control" name="captcha" value="" required="required"/>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-4">
						<input class="btn btn-primary" type="submit" name="envoyer" value="Envoyer"/>
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
	if(isset($_POST["titre"]) && isset($_POST["texte"]) && isset($_POST["envoyer"])){
		$titre=$_POST["titre"];
		$texte=$_POST["texte"];
		$personne=$_SESSION['id'];
		$envoyer=$_POST["envoyer"];
		$essaiUser=$_POST["captcha"];
		if(!empty($titre) && !empty($texte) && !empty($envoyer)){
			
			//Vérification du captcha
			if($captcha != $essaiUser){
				echo '<script>alert("Captcha Incorrect !");</script>';	
			}
			else{		
				try{
						$requete="select * from article";
						
						$reponse = $bdd->query($requete);
						
						$trouve=0;
						
						while ($ligne = $reponse->fetch()){
								if($trouve==0 && $ligne['titre']==$titre){
									$trouve=1;
									echo '<script>alert("Changer de titre : Article deja existant");</script>';
							}
						}
						if($trouve==0){
							$image='';
							
							//SI PROBLEME D'IMPORT RETIRER remettre -> TOFIX
							//if(isset($_FILES['image']) && count($_FILES['image']['error']) == 1 && $_FILES['image']['error'][0] > 0){						
							if(!empty($_FILES['image']['tmp_name']) && count($_FILES['image']['error']) == 1){						

								//UPLOAD DE L'IMAGE DANS LE DOSSIER IMG
								$content_dir = '../img/'; // dossier où sera déplacé le fichier

								$tmp_file = $_FILES['image']['tmp_name'];

								if( !is_uploaded_file($tmp_file) )
								{
									exit("L'image est introuvable");
								}

								// on vérifie maintenant l'extension
								$type_file = $_FILES['image']['type'];

								if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
								{
									exit("Le fichier n'est pas une image");
								}

								// on copie le fichier dans le dossier de destination
								$name_file = $_FILES['image']['name'];

								if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
								{
									exit("Impossible de copier l'image dans $content_dir");
								}
								$image="$content_dir$name_file";
								echo "L'image a bien été uploadé";
							}
							else{
									$image='';
							}
							//AJOUT DE L'ARTICLE DANS LA BDD
							$ajout = $bdd->prepare('INSERT INTO article (titre, texte, image, idPersonne) VALUES (:titre, :texte, :image, :idPersonne)');
							$ajout->bindParam(':titre', $titre);
							$ajout->bindParam(':image', $image);
							$ajout->bindParam(':texte', $texte);
							$ajout->bindParam(':idPersonne', $personne);
							$ajout->execute();
							

							
							echo '<script>alert("Article enregistré");</script>';
							header('Location:./accueil.php');
						}
		
				}
				catch (Exception $e){
				
					die('Erreur : ' . $e->getMessage());
				}
			}
		}
		else{
			echo '<script>alert("Un des parametres est vide")</script>';
		}
	}
	
	$_SESSION['captcha'] = simple_php_captcha();
?>