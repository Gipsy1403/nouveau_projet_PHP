<?php
$bdd = new PDO('mysql:host=localhost;port=3307;dbname=film;charset=utf8', 'root', '');

if(isset($_FILES["images"])){
	// vérifie si une image a été téléchargée via le formulaire html
	  $imageName = $_FILES["images"]['name'];
	  $imageInfo = pathinfo($imageName);
	//   la fonction pathinfo créé un nouveau tableau avec les données de l'image (ici le nom)
	  $imageExt = $imageInfo['extension'];
	//   extraction, à partir du tableau généré par la fonction pathinfo, de l'extension du fichier image
	  $autorizedExt = ['png','jpeg','jpg','webp','bmp','svg'];
	//   je créée un nouveau tableau avec les extensions que j'autorise au téléchargement de l'image

	  // Verification de l'extention du fichier
	  if(in_array($imageExt,$autorizedExt)){
		  //   La fonction in_array() vérifie si l'extension du fichier téléchargé ($imageExt) est présente dans le tableau $autorizedExt. Si c'est le cas, le fichier est autorisé, et le script passe à l'étape suivante.
		 $uniqueName = time() . rand(1,1000) . "." . $imageExt;
		//  permet d'avoir un nom unique pour l'image, en intégrant des millisecondes depuis 1970 et en plus un chiffre aléatoire entre 1 et 1000
		 move_uploaded_file($_FILES["images"]['tmp_name'],"image/".$uniqueName);
		//  Déplace l'image (avec son nom unique) vers un emplacement temporaire puis enfin la déplace dans mon dossier image
	  }else{
		 echo "<p>Veuillez choisir un format de fichier valide(png,jpg,webp,bmp,svg)</p>";
	  }
   }
   // Affichage de l'image téléchargée
   if(isset($uniqueName)){
	// si le téléchargement a réussi, alors une balise img est générée afin que l'image s'affiche à l'écran avec son nouveau nom et son emplacement dans mon repertoire
	  echo "<img src='image/" . $uniqueName . "' alt='image envoyée'>";
	  header("location:index.php");
	  
   }
if(isset($_POST["titre"])&&isset($_POST["duree"])&&isset($_POST["date"])){
	$titre=htmlspecialchars($_POST["titre"]);
	$duree=htmlspecialchars($_POST["duree"]);
	$date=htmlspecialchars($_POST["date"]);

	// on peut mettre toutes les vérifications ici
	$request=$bdd->prepare("INSERT INTO fiche_film (titre,date, duree, images)
						-- value (?, ?, ?)
						VALUE (:titre, :date, :duree, :images)
						-- autre maniere de faire 
					");
	$request->execute([
		"titre"=>$titre,
		"date"=>$date,
		"duree"=>$duree,
		"images"=>$uniqueName
	]);

}
	 
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Ajouter un film et photo</title>
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
		<input type="file" name="images" value="<?php echo $data["images"]?>">
		<button>envoyer</button>
	</form>
</body>
</html>