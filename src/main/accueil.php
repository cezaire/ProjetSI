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
			<h1 style='text-align: center;'>BLOG TA MIAGE</h1>
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

					echo '<table class="table table-bordered">';
						echo '<tbody>';
							echo '<tr> ';
							echo "<td class='text-center'><h3>Article N°$donnees[idArticle] :";
							echo " $donnees[titre]</h3></td></tr>";
							echo "<tr><td> $donnees[texte]</td></tr>";
							if($donnees['image']!=null){
								echo	"<tr><td class='text-center'><img src='$donnees[image]' alt=''/></td></tr>";
							}
							echo "<tr><td><i>Auteur : $donnees[idPersonne]</i></td></tr>";
							//echo	"<tr><td class='text-right'><a href='#'>Répondre</a>&nbsp<a href='#'>Lire les commentaires</a></td></tr>";
							echo "<tr><td class='text-right'><a href='#' onclick='popUp($donnees[idArticle]);'><button type='button' class='btn btn-default btn-sm'>";
								echo "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Répondre";
							echo "</button></a>";
							echo "<button type='button' class='btn btn-default btn-sm'>";
								echo "<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> Lire les commentaires";
							echo "</button></td></tr>";
						echo "</tbody>";
					echo '</table><br/><br/>';
			}
			

			$reponse->closeCursor();
			// Puis on fait une boucle pour écrire les liens vers chacune des pages
			echo '<h3 id="entetePage" class="text-center">Page : ';
			for ($i = 1 ; $i <= $nombreDePages ; $i++)
			{
				echo '<a id="page" href="accueil.php?page=' . $i . '">' . $i . '</a> ';
			}
			echo '</h3>';		

		}
		catch (Exception $e){
		
			die('Erreur : ' . $e->getMessage());
			}
		?>
		
		
	</div>
	</body>
	
	<footer>
	<span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
	<?php echo compteurGlobal();?>
	</footer>
</html>