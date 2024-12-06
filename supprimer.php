<?php
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');
// je me connecte à la base de données

//////////////////////////PERMETTRE A L UTILISATEUR DE SUPPRIMER LES CHAMPS SAISIES DU FORMULAIRE
if(isset($_GET['id'])){
	$id=htmlspecialchars($_GET['id']);
};

	$recupId=$bdd->prepare("DELETE FROM fiche_film 
						WHERE id=:id
					");
					// :id de la requete SQL (prepare)se fait remplacer par l'id de la méthode $recupId->execute(php) par la variable $id
$recupId->execute([
	"id"=>$id,
]);
header("location:index.php");
//  renvoie l'utilisateur sur la page index.php une fois avoir cliquer sur le bouton supprimer.
?>