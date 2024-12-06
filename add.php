<?php
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');
if(isset($_POST["titre"])&&isset($_POST["duree"])&&isset($_POST["date"])){
	$titre=htmlspecialchars($_POST["titre"]);
	$duree=htmlspecialchars($_POST["duree"]);
	$date=htmlspecialchars($_POST["date"]);

	// on peut mettre toutes les vérifications ici
	$request=$bdd->prepare("INSERT INTO fiche_film (titre,date, duree)
						-- value (?, ?, ?)
						VALUE (:titre, :date, :duree)
						-- autre maniere de faire 
					");
	$request->execute([
		"titre"=>$titre,
		"date"=>$date,
		"duree"=>$duree
	]);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Ajouter un film</title>
</head>
<body>
	<?php include("nav.php")?>

	<form action="add.php" method="post" enctype="multipart/form-data">
		<label for="titre">Le titre de mon film</label>
		<input type="text" id="titre" name="titre">
		<label for="duree">La durée de mon film</label>
		<input type="text" id="duree" name="duree">
		<label for="date">L'année de sortie</label>
		<input type="text" id="date" name="date">
		<input type="file" name="userfile">
		<button>envoyer</button>
	</form>
</body>
</html>