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
		<title>Validation des commentaires</title>
		<meta charset="utf-8"/>	
	</head>
	
	<header>
	<div class='page-header'>
		<div class='container'>
			<h1 style='text-align: center;'>Validation des commentaires</h1>
		</div>
	</div>
	</header>
	
	<body>
	<div class="container">
	
	
	<?php
	$i=1;
	
	//requete pour choisir les mots à valider
	if(isset($_POST["valide"])){
		$valide=$_POST["valide"];
		
		$bdd->query("UPDATE commentaire SET valide = 'oui' WHERE idCommentaire = '".$valide."'");
	}

	if(isset($_POST["suppression"])){
		$suppression=$_POST["suppression"];
		
		$bdd->query("delete FROM commentaire WHERE idCommentaire = '".$suppression."'");
	}

	//Nombre d'article par page
	$nombreDeMessagesParPage = 10;

	$reponse = $bdd->query("SELECT COUNT(*) AS nb_messages FROM commentaire c, article a, personne p where c.valide='non' and c.idArticle=a.idArticle and a.idPersonne = p.id and a.idPersonne='".$_SESSION['id']."'");
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
	
	//Si l'auteur de l'article a des commentaires
	$result = $bdd->query("SELECT c.idCommentaire, c.auteur, c.texte, c.valide, c.idArticle FROM commentaire c, article a, personne p where c.valide='non' and c.idArticle=a.idArticle and a.idPersonne = p.id and a.idPersonne='".$_SESSION['id']."' ORDER BY idArticle DESC LIMIT " . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage);
	
	echo "<table class='table table-bordered'>
	<tr>
	<th>Id</th>
	<th><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Auteur</th>
	<th>Texte</th>
	<th>Id de l'article</th>
	<th><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Validation</th>
	<th><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Suppression</th>
	</tr>
	<tbody>";
	
	while($row = $result->fetch()){	
	  echo "<tr>";
	  echo "<td>" . $row['idCommentaire'] . "</td>";
	  echo "<td>" . $row['auteur'] . "</td>";
	  echo "<td>" . $row['texte'] . "</td>";
	  echo "<td>" . $row['idArticle'] . "</td>";
		//  
	  $valide=$row['idCommentaire'];
	  echo "<td><form method='post'><button name=valide type='submit' class='btn btn-success' value='".$valide."' >Validation</button></form></td>";
	  $suppression=$row['idCommentaire'];  
	  echo "<td><form method='post'><button name=suppression type='submit' class='btn btn-danger' value='".$suppression."' >Suppression</button></form></td>";
	  echo "</tr>";
	  }
	echo "</tbody>";
	echo "</table>";  	
	
	
	echo '<h3 id="entetePage" class="text-center">Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++){
		//différencier la page actuelle
		if($page == $i){
			echo '<a id="pageCourante">' . $i . '</a> ';
		}
		else{
			echo '<a id="page" href="validation.php?page=' . $i . '">' . $i . '</a> ';
		}
	}
	echo '</h3>';	

?>

	</div>
	
	</body>
	
	
	<footer>
		<a href="./accueil.php">Retour à l'accueil</a>
	</footer>

</html>