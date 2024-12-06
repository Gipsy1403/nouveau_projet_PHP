<?php
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');

if(isset($_GET['id'])){
	$id=htmlspecialchars($_GET['id']);
};

	$voirPlus=$bdd->prepare("SELECT id,titre,date, duree
						FROM fiche_film 
						WHERE id=:id
					");
					// :id de la requete SQL (prepare)se fait remplacer par l'id de la méthode $voirPlus->execute(php) par la variable $id
$voirPlus->execute([
	"id"=>$id,
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Voir Plus</title>
</head>
<body>
	<?php include("nav.php")?>
	<h1>Voir plus...</h1>
	<section>
	<?php
	$data=$voirPlus->fetch();
	?>
		<article>
			<p>Film : <?php echo $data["titre"]?></p>
			<p>Durée : <?php
			$min = $data["duree"]%60;
			$heure = ($data["duree"]-$min)/60;
			echo $heure. "h".$min. "min";?></p>
			<p>Sortie : <?php echo $data["date"]?></p>
			<a href="">modifier</a>
			<a href="">supprimer</a>
		</article>

	</section>	

</body>
</html>