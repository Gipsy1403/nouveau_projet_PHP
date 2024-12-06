<?php
$bdd = new PDO('mysql:host=localhost;dbname=film;charset=utf8', 'root', '');
// je me connecte à la base de données

//////////////////////////PERMETTRE A L UTILISATEUR DE VISUALISER LES CHAMPS DU FORMULAIRE AVEC SES SAISIES POUR LES MODIFIER
if(isset($_GET['id'])){
	$id=htmlspecialchars($_GET['id']);
};

	$visualiser=$bdd->prepare("SELECT id,titre,date, duree
						FROM fiche_film 
						WHERE id=:id
					");
					// :id de la requete SQL (prepare)se fait remplacer par l'id de la méthode $voirPlus->execute(php) par la variable $id
$visualiser->execute([
	"id"=>$id,
]);
?>
<!-- // /////////////////////// PERMETTRE A L UTILISATEUR DE MODIFIER LE FORMULAIRE -->
<?php
if(isset($_POST['id'])&& isset($_POST['newtitre'])&& isset($_POST['newduree'])&& isset($_POST['newdate'])){
	$id=htmlspecialchars($_POST['id']);
	$newtitre=htmlspecialchars($_POST['newtitre']);
	$newduree=htmlspecialchars($_POST['newduree']);
	$newdate=htmlspecialchars($_POST['newdate']);

// isset vérifie s'il existe un id dans l'url. Je déclare mon id en variable et le protège des attaques (injection) par la methode htmlspecialchars
	$modifier=$bdd->prepare("UPDATE fiche_film 
						SET 
							titre=:newtitre,
							date = :newdate,
							duree= :newduree
						WHERE id=:id
					");
					// je fais une requête SQL permettant de modifier les colonnes titre, durée et date par rapport à l'id
	$modifier->execute([
		"id"=>$id,
		"newtitre"=>$newtitre,
		"newduree"=>$newduree,
		"newdate"=>$newdate,

	]);
	header("location:index.php");
// "id"=>$id = signifie que l'"id" figurant dans l'URL est associé (=>) avec la variable "$id"
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Modifier les données</title>
</head>
<body>
<h1>Visualisation du formulaire rempli</h1>
	<section>
	<?php
$data=$visualiser->fetch();
?>

	<?php include("nav.php")?>

	<form action="modifier.php" method="post">
		<input type="hidden" name="id" value=<?php echo $data["id"]?>>
		<label for="newtitre">Titre</label>
		<input type="text" id="newtitre" name="newtitre" value=<?php echo $data["titre"]?>>
		<label for="newduree">Durée</label>
		<input type="text" id="newduree" name="newduree" value=<?php echo $data["duree"]?>>
		<label for="newdate">Année de sortie</label>
		<input type="text" id="newdate" name="newdate"value=<?php echo $data["date"]?>>
		<button>Modifier</button>
	</form>
</body>
</html>