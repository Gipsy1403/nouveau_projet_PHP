<?php
$bdd = new PDO('mysql:host=localhost;port=3307;dbname=users;charset=utf8', 'root', '');
if(isset($_GET['id'])){
	$id=htmlspecialchars($_GET['id']);
};

	$inscription=$bdd->prepare("INSERT INTO users (username, password)
						VALUES (:username, :password)
					");
$inscription->execute([
	"username"=$username,
	"password"=$password
]);

?>
<?php include("nav.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>S'inscrire</title>
</head>
<body>
	<form action="inscription.php" method="post">
		<label for="username">Nom</label>
		<input type="text" id="username" name="username">
		<label for="password">Mot de passe</label>
		<input type="password" id="password" name="password">
		
		<button>S'incrire</button>
	</form>
</body>
</html>