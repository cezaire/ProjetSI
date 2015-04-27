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
			  <li><a href="#" title="Visiteurs">Visiteurs</a></li>
			  <?php  if(isset($_SESSION['id'])){ echo "<li><a href='article.php' title='Créer un article'>Créer un article</a></li>";} ?>
			  <li><a href="#" title="Aide">Aide</a></li>
			  <?php  if(isset($_SESSION['id'])){ echo "<li><a href='deconnexion.php' title='Déconnexion'>Déconnexion</a></li>";} ?>

			  
			</ul>
		</div>
		<article>
			<h1><b>Blog</b></h1>
			<p>Avant-propos

		Cette charte a été élaborée afin de préciser aux utilisateurs du site http://www.METTRELAPAGE.net les conditions d'utilisation de ce dernier, notamment l'utilisation des services de communication (tels que le forum) permettant à des utilisateurs du monde entier, possédant généralement des cultures différentes, d'échanger des messages en ligne. 


		Toute personne naviguant sur le site est considérée comme un utilisateur, qu'elle soit identifiée ou non sur le site. 


		Le forum de NOMFORUM est librement ouvert pour permettre au plus grand nombre de discuter librement sur des sujets concernant l'informatique et les nouvelles technologies. Toutefois, afin de garantir la meilleure qualité dans les échanges et de protéger les utilisateurs des messages insultants ou inappropriés d'usagers indélicats, le forum est modéré a posteriori, ce qui signifie que des personnes accréditées (les modérateurs) ont la possibilité de supprimer les messages ne se conformant pas à la présente charte. 

		Périmètre

		NOMFORUM (CCM) met à disposition de tous des documentations gratuites concernant l'informatique et les accompagne de services en ligne. CCM a été développé de manière à offrir un service gratuit de qualité à ses différents utilisateurs afin de permettre le partage de l'information en matière de nouvelles technologies. Il s'adresse ainsi aussi bien à des enfants mineurs qu'à des étudiants, à des personnes dans un contexte professionnel, ou bien à des personnes retraitées cherchant à approfondir leurs connaissances en matière de nouvelles technologies. 


		Dans ce cadre, tous les utilisateurs du site se doivent de respecter les autres usagers en adoptant une attitude citoyenne conforme à la philosophie du site. 


		Dans ce même esprit, chaque membre se doit d'utiliser son compte de manière personnelle ; aussi, il convient de ne pas divulguer son mot de passe quelles qu'en soient les circonstances. 


		Les propositions d'aide par messagerie privée ou en prise de contrôle à distance ne sont pas permises sur le forum et les intervenants verront leurs messages supprimés. Exception faite des intervenants certifiés ccm dans le cadre d'un suivi de dossier et de besoin de numéro confidentiel ; le reste de la discussion devant se poursuivre sur le forum. 
		</p>
		</article>
	</div>
	</body>
</html>