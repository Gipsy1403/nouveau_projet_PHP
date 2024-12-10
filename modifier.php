<?php
$bdd = new PDO('mysql:host=localhost;port=3307;dbname=film;charset=utf8', 'root', '');
// je me connecte à la base de données

//////////////////////////PERMETTRE A L UTILISATEUR DE VISUALISER LES CHAMPS DU FORMULAIRE AVEC SES SAISIES POUR LES MODIFIER
if(isset($_GET['id'])){
	$id=htmlspecialchars($_GET['id']);
};

	$visualiser=$bdd->prepare("SELECT *
						FROM fiche_film 
						WHERE id=:id
					");
					// :id de la requete SQL (prepare)se fait remplacer par l'id de la méthode $visualiser->execute(php) par la variable $id
$visualiser->execute([
	"id"=>$id,
]);
// ///////////////////////// IMAGE - NOM UNIQUE - EXTENSION/////////////////////////////////
if(isset($_FILES["images"])){
	$imageName = $_FILES["images"]['name'];
	$imageInfo = pathinfo($imageName);
	$imageExt = $imageInfo['extension'];
	$autorizedExt = ['png','jpeg','jpg','webp','bmp','svg'];
   
	// Verification de l'extention du fichier
	if(in_array($imageExt,$autorizedExt)){
	    $uniqueName = time() . rand(1,1000) . "." . $imageExt;
	    move_uploaded_file($_FILES["images"]['tmp_name'],"image/".$uniqueName);
	   
	}else{
	    echo "<p>Veuillez choisir un format de fichier valide(png,jpg,webp,bmp,svg)</p>";
	}
 }
 // Affichage de l'image téléchargée
 if(isset($uniqueName)){
	echo "<img src='image/" . $uniqueName . "' alt='image envoyée'>";
 }
?>
<!-- // /////////////////////// PERMETTRE A L UTILISATEUR DE MODIFIER LE FORMULAIRE -->
<?php
if(isset($_POST['id'])&& isset($_POST['newtitre'])&& isset($_POST['newduree'])&& isset($_POST['newdate'])){
	$id=htmlspecialchars($_POST['id']);
	$newtitre=htmlspecialchars($_POST['newtitre']);
	$newduree=htmlspecialchars($_POST['newduree']);
	$newdate=htmlspecialchars($_POST['newdate']);
	$images=htmlspecialchars($_POST["images"]);

// isset vérifie s'il existe un id dans l'url. Je déclare mon id en variable et le protège des attaques (injection) par la methode htmlspecialchars
	$modifier=$bdd->prepare("UPDATE fiche_film 
						SET 
							titre=:newtitre,
							date = :newdate,
							duree= :newduree,
							images=:images
						WHERE id=:id
					");
					// je fais une requête SQL permettant de modifier les colonnes titre, durée et date par rapport à l'id
	$modifier->execute([
		"id"=>$id,
		"newtitre"=>$newtitre,
		"newduree"=>$newduree,
		"newdate"=>$newdate,
		"images"=>$uniqueName
	]);

	$imageNull = '<i class="fa-regular fa-image"></i>';
if(isset($_FILES["images"])){
	echo '<img src="image/' . $data["images"] . '" alt="' . $data["titre"] . '">';
}else{
		echo $imageNull;
	};

	header("location:index.php");
// "id"=>$id = signifie que l'"id" figurant dans l'URL est associé (=>) avec la variable "$id"
};


?>
<?php include("nav.php")?>

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
	
	<?php
$data=$visualiser->fetch();
?>


	<form action="modifier.php" method="post" enctype="multipart/form-data">
		

		<input type="hidden" name="id" value="<?php echo $data["id"]?>">
		<label for="newtitre">Titre</label>
		<input type="text" id="newtitre" name="newtitre" value="<?php echo $data["titre"]?>">
		<label for="newduree">Durée</label>
		<input type="text" id="newduree" name="newduree" value="<?php echo $data["duree"]?>">
		<label for="newdate">Année de sortie</label>
		<input type="text" id="newdate" name="newdate"value="<?php echo $data["date"]?>">
		<input type="file" id="images" name="images" value="<?php echo $data["images"]?>">
		<button>Modifier</button>
	</form>
</body>
</html>