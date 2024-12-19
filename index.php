<?php
include ("pokemon.php");
// include ("autre.php");


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="style.css">

	<title>Exercices POO pokemon</title>
</head>
<body>

<p>
<?php


	$pikachu = new Pokemon("Pikachu",55,"Electrique",200);
	$salameche = new Pokemon("Salamèche",60,"Feu",120);
	$carapuce = new Pokemon("Carapuce",50,"Eau",150);

	$pikachu->pokedex();
	$salameche->pokedex();
	$carapuce->pokedex();

	$pikachu->frapper($carapuce);



?>
</p>


</body>
</html>