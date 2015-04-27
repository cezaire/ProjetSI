<?php
session_start();
?>

<!DOCTYPE html>
<html>

	<head>
		<link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>	
		<title>ACCUEIL </title>  
		<meta charset="utf-8"/>
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>ACCUEIL</h1>
		</div>
	</div>
	</header>
	
	<body>
	<div class="container">
		<div class="text-align">
			<ul class="list-inline" id="Menu">
			  <li><a href="connexionUsers.php" title="Connexion">Connexion</a></li>
			  <li><a href="Inscription.php" title="Inscription">Inscription</a></li>
			  <?php  if(isset($_SESSION['id'])){ echo "<li><a href='article.php' title='Créer un article'>Créer un article</a></li>";} ?>
			  <?php  if(isset($_SESSION['id'])){ echo "<li><a href='deconnexion.php' title='Déconnexion'>Déconnexion</a></li>";} ?>

			  
			</ul>
		</div>
		<article>
			<h1><b>Blog</b></h1>
			<p>Avant-propos

				Ce site est un blog interactif, a vous de le compléter !  
			</p>
		</article>
		<?php
		try{

			$bdd = new PDO('mysql:host=localhost;dbname=projetsi;charset=utf8', 'root', 'root');
			
			//Nombre d'article par page
			$nombreDeMessagesParPage = 2;

			//$reponse = $bdd->prepare("SELECT COUNT(*) AS nb_messages FROM mot where valide = :valide");
			$reponse = $bdd->query("SELECT COUNT(*) AS nb_messages FROM article");
			//$reponse->execute(array('valide' => 'oui'));
			$donnees = $reponse->fetch();

			$totalDesMessages = $donnees['nb_messages'];
			// On calcule le nombre de pages à créer
			$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
			// Puis on fait une boucle pour écrire les liens vers chacune des pages
			echo 'Page : ';
			for ($i = 1 ; $i <= $nombreDePages ; $i++)
			{
				echo '<a id="page" href="accueil.php?page=' . $i . '">' . $i . '</a> ';
			}

			 
			 
			// --------------- Étape 3 ---------------
			// Maintenant, on va afficher les messages
			// ---------------------------------------
			 
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

			//$reponse = $bdd->query("SELECT * FROM mot where valide='oui' ORDER BY num_m DESC LIMIT " . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
			$reponse = $bdd->query("SELECT * FROM article ORDER BY idArticle DESC LIMIT " . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);


			//echo '<table id="consultation" border="1">';

			//while ($donnees = mysql_fetch_array($reponse)) 
			while($donnees = $reponse->fetch())
			{
			echo "<div class='table table-bordered'>";
				echo '<table border="1">';
				echo	'<tr> ';
				echo	"<td>N° Article : $donnees[idArticle]</td></tr>";
				echo	"<tr><td> $donnees[titre]</td></tr>";
				echo	"<tr><td> $donnees[texte]</td></tr>";
				echo	"<tr><td><img src='$donnees[image]' alt=''/></td></tr>";
				echo	"<tr><td>Auteur : $donnees[idPersonne]</td></tr>";

				echo '</table><br/>';
			echo "</div>";
			}
			

			$reponse->closeCursor();

		}
		catch (Exception $e){
		
			die('Erreur : ' . $e->getMessage());
			}
		?>
		
		
	</div>
	</body>
</html>