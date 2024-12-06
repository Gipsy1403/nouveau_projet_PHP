<?php
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');
$request=$bdd->prepare("SELECT *
					FROM fiche_film");
$request->execute([]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Exercices PHP</title>
</head>
<body>
<?php include("nav.php")?>

	<h1>Récupération de la requête</h1>
	<section>
	<?php
while($data=$request->fetch()):?>
		<article>
			<p><?php echo $data["titre"]?></p>
			<p>Durée : <?php
			$min = $data["duree"]%60;
			$heure = ($data["duree"]-$min)/60;
			echo $heure. "h".$min. "min";?></p>
			<p><?php echo $data["date"]?></p>
			<a href="voirplus.php?id=<?php echo $data["id"]?>">Voir plus</a>
			<!-- url permet d'envoyer une requete GET (grace au ?, clée, egal)-->
			<a href="modifier.php?id=<?php echo $data["id"]?>">modifier</a>
			<a href="supprimer.php?id=<?php echo $data["id"]?>">supprimer</a>
		</article>
<?php endwhile ?>
	</section>	




</body>
</html>