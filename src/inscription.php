<!DOCTYPE html>
<html>
	<head>
		<title> Inscription </title>
		<meta charset="utf-8"/>	
		<style>h1{color: red; font-weight: bold; text-decoration: underline;}
		h2{font-weight: bold; text-decoration: underline;}
		h3{text-align: center; color: blue; font-size: 3em; text-decoration: underline;}
		form p label{margin-left: -7em; float: left;width:50%; text-align: right; padding: 1em;}
		form p input {padding: 6px; background-color: #ddd;border-style: groove;border-width: 5px;border-color: #444;}
		form p #sansLabel{margin-left: -3em; font-size: 130%; font-weight: bolder; float: left;}
		.erreur{color: red; text-align: center; font-weight: bold; font-size: 2em;}
		table{margin-left: auto; margin-right: auto;}
		td{text-align: center;}
		</style>
	</head>
	
	<body>
		<form action="#" method="post">
			<p><label>Identifiant</label><input type="text" name="id" value=""/></p>
			<p><label>Email</label><input type="text" name="email" value=""/></p>
			<p><label>Mot de Passe</label><input type="password" name="mdp" value=""/></p>
			<p><label id='sansLabel'></label><input type="submit" name="inscription" value="inscription"/></p>
		</form>
	</body>

</html>

<?php
	
	
	if(isset($_POST["id"]) && isset($_POST["mdp"]) && isset($_POST["email"]) && isset($_POST["inscription"])){
		$id=$_POST["id"];
		$mdp=$_POST["mdp"];
		$email=$_POST["email"];
		$inscription=$_POST["inscription"];
		if(!empty($id) && !empty($mdp) && !empty($inscription) && !empty($email)){
		
			try{
	
				$bdd = new PDO('mysql:host=localhost;dbname=projetsi;charset=utf8', 'root', 'root');
				
					$requete="select * from user";
					
					$reponse = $bdd->query($requete);
					
					$trouve=0;
					
					while ($ligne = $reponse->fetch()){
							if($trouve==0 && $ligne['id']==$id){
								$trouve=1;
								echo("Changer d'Identifiant : Utilisateur deja existant");
						}
					}
					if($trouve==0){
					
						$ajout = $bdd->prepare("INSERT INTO user (id,email,mdp) VALUES (:id, :email, :mdp)");
						$ajout->bindParam(':id', $id);
						$ajout->bindParam(':email', $email);
						$ajout->bindParam(':mdp', $mdp);
						$ajout->execute();
						
						echo '<script>alert("inscription reussie");</script>';
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