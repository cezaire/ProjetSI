<?php
session_start();
require_once('conf.inc.php');
require_once('compteur.php');
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
			  <?php  if(!isset($_SESSION['id'])){ echo "<li><a href='connexionUsers.php' title='Connexion'>Connexion</a></li>";} ?>
			  <?php  if(!isset($_SESSION['id'])){ echo "<li><a href='inscription.php' title='Inscription'>Inscription</a></li>";} ?>
			  <?php  if(isset($_SESSION['id'])){ echo "<li><a href='article.php' title='Créer un article'>Créer un article</a></li>";} ?>
			  <?php  if(isset($_SESSION['id'])){ echo "<li><a href='deconnexion.php' title='Déconnexion'>Déconnexion</a></li>";} ?>

			  
			</ul>
		</div>
		<article>
			<h1><b>Blog</b></h1>
			<p>Avant-propos

				Ce site est un blog interactif, a vous de le compléter ! Issue d'une L3 MIAGE en apprentissage, nous avons pour objectif de créer 
				un blog responsive design, facile d'utilisation et ergonomique.
				Pour la moindre remarque : <strong><a>blablabla@gmail.com</a></strong>
			</p>
		</article>
		<?php
		try{
			
			//Nombre d'article par page
			$nombreDeMessagesParPage = 2;

			$reponse = $bdd->query("SELECT COUNT(*) AS nb_messages FROM article");
			$donnees = $reponse->fetch();

			$totalDesMessages = $donnees['nb_messages'];
			// On calcule le nombre de pages à créer
			$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
			// Puis on fait une boucle pour écrire les liens vers chacune des pages
			echo '<h3 class="text-center">Page :';
			for ($i = 1 ; $i <= $nombreDePages ; $i++)
			{
				echo '<a id="page" href="accueil.php?page=' . $i . '">' . $i . '</a> ';
			}
			echo '</h3>';
			 
			 
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

			$reponse = $bdd->query("SELECT * FROM article ORDER BY idArticle DESC LIMIT " . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);


			while($donnees = $reponse->fetch()){

					echo '<table class="table table-bordered" border="3 solid black">';
					echo	'<tr> ';
					echo	"<td class='text-center'>N° Article : $donnees[idArticle]</td></tr>";
					echo	"<tr><td class='text-center'><h3> $donnees[titre]</h3></td></tr>";
					echo	"<tr><td> $donnees[texte]</td></tr>";
					if($donnees['image']!=null){
						echo	"<tr><td class='text-center'><img src='$donnees[image]' alt=''/></td></tr>";
					}
					echo	"<tr><td><i>Auteur : $donnees[idPersonne]</i></td></tr>";
					echo	"<tr><td class='text-right'><a href='#'>Commentaires</a></td></tr>";
					echo '</table><br/><br/>';
			}
			

			$reponse->closeCursor();

		}
		catch (Exception $e){
		
			die('Erreur : ' . $e->getMessage());
			}
		?>
		
		
	</div>
	</body>
	
	<footer>
	<?php echo compteurGlobal();?>
	</footer>
</html>