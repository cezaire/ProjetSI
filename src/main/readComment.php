<?php
session_start();
require_once('conf.inc.php');
require_once('compteur.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../style/base.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../style/bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/popup.js"></script>	
		<title>ACCUEIL </title>  
		<meta charset="utf-8"/>
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>Commentaires</h1>
		</div>
	</div>
	</header>
	
	<body>
	<div class="container">
		<?php
		try{
			$article=$_GET["idArticle"];
			//Nombre d'article par page
			$nombreDeMessagesParPage = 10;

			$reponse = $bdd->query("SELECT COUNT(*) AS nb_messages FROM commentaire");
			$donnees = $reponse->fetch();

			$totalDesMessages = $donnees['nb_messages'];
			// On calcule le nombre de pages à créer
			$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
	

			 
			if (isset($_GET['page']))
			{
					$page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
			}
			else // La variable n'existe pas, c'est la première fois qu'on charge la page
			{
					$page = 1; // On se met sur la page 1 (par défaut)
			}
			 
			// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
			$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;

			$reponse = $bdd->query("SELECT * FROM commentaire WHERE idArticle=$article ORDER BY idCommentaire DESC LIMIT " . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);

			while($data = $reponse->fetch()){
			
				echo '<table class="table table-bordered">';
					echo '<tbody>';
						echo '<tr> ';
						echo "<td><p><i>Commentaire N°$data[idCommentaire] :";
						echo " $data[auteur]<i></p></td></tr>";
						echo "<tr><td> $data[texte]</td></tr>";
					echo "</tbody>";
				echo '</table><br/><br/>';
			}
			

			$reponse->closeCursor();
			// Puis on fait une boucle pour écrire les liens vers chacune des pages
			echo '<h3 id="entetePage" class="text-center">Page : ';
			for ($i = 1 ; $i <= $nombreDePages ; $i++){
				//différencier la page actuelle
				if($page == $i){
					echo '<a id="pageCourante">' . $i . '</a> ';
				}
				else{
					echo '<a id="page" href="readComment.php?idArticle='.$article.'&page=' . $i . '">' . $i . '</a> ';
				}
			}
			echo '</h3>';		

		}
		catch (Exception $e){
		
			die('Erreur : ' . $e->getMessage());
			}
		?>
		
		
	</div>
	</body>

</html>