<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitionnal//EN" 
	"http://wwww.w3.org/TR/xhtmll/DTD/xhtmll-transitional.dtd">

<html>
<style>
h1{color: red; font-weight: bold; text-decoration: underline;}
		
		
h2{font-weight: bold; text-decoration: underline;}
		

		
form p label{margin-left: -3em; float: left;width:50%; text-align: right; padding: 1em;}
		
form p input {padding: 6px; background-color: #ddd;border-style: groove;border-width: 5px;border-color: #444;}
		
form p #sansLabel{margin-left: -3em; font-size: 130%; font-weight: bolder; float: left;}
		
.erreur{color: red; text-align: center; font-weight: bold; font-size: 2em;}
		
table{margin-left: auto; margin-right: auto;}
		
td{text-align: center;}

body{
background-color:DarkSalmon; 
color white;
}
header h3{
height:50px;
font-size:30px;
text-align:center;
}
header{
background-color:OrangeRed;
width: auto;
color:white;
}
article{
width: 500px;
font-style:italic;
}
h1{
color:white;
}
a{
color:white;
background-color:OrangeRed;
 line-height: 10px;
 height:50px;
}
input{
color:teal;
}
label{
color:white;
}

ul#Menu { 
width : 340px; 
height : 30px;
margin : 2em 0 0 0;
padding : 0;
background-color : #f4f9fd;
border : 1px dashed black;
list-style-type : none; 
}
 
ul#Menu li {
padding : 0 0.5em;  
line-height : 30px;
display:inline;
border-left : 2px dashed black; 
}
 

ul#Menu a {
color : black;
text-decoration : none;
padding : 0 0.5em; 
font :  0.8em "Trebuchet MS";
}
 
ul#Menu a:hover { text-decoration : underline; }


</style>
<head>
  <title> PAGE CONNEXION </title>  
<meta charset="utf-8"/>
</head>
<body>
<header>
<h3> PAGE CONNEXION </h3>
</header>

</body>


</html>

<?php
session_start();
echo showForm();

if(isset($_POST['id']) && isset($_POST['mdp']) && isset($_POST['connexion'])){
	$id = $_POST['id']; 
	$mdp = $_POST['mdp']; 
	$result=false; 
	
	if(!empty($id) && !empty($mdp)){
		
		try{
			
			$bdd = new PDO('mysql:host=localhost;dbname=projetsi;charset=utf8', 'root', 'root');
		
				$requete="select * from user where id='".$id."' AND mdp='".$mdp."'";
				$reponse = $bdd->query($requete);
				
				$verif=$reponse->fetch();
				
				if($verif){
					$_SESSION['id']=$id;
					$_SESSION['mdp']=$mdp;
					header('Location:https://www.google.fr/?gws_rd=ssl');
				}
				else{
					echo 'Identifiant ou Mot de Passe incorrects';
				}
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
	}
}

//echo '<a href="Recapitulatif.php"> Retour au recapitulatif  </a>';

function showForm(){

$r=''; 
$r.='<form method="post" action="">'; 
$r.='<p><label>Identifiant</label><input type="text" name="id"/></p>'; 
$r.='<p><label>Mot de Passe</label><input type="password" name="mdp"/></p>'; 
$r.='<p><label id="sansLabel"></label><input id="submit" type="submit" name="connexion" value="connexion"/>'; 
$r.='<label>   </label><input id="reset" type="reset" name="reset" value="reset"/></p>';
$r.='<p><a href="Acceuil.php"> Retour Acceuil </a></p>';
$r.='</form>'; 

return $r;

}
?>