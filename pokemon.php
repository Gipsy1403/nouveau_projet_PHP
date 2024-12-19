<?php

class Pokemon{
	private $nom;
	private $puisAttack;
	private $type;
	private $ptLife;


	function __construct(
		$nom,
		$puisAttack,
		$type,
		$ptLife
	){
		$this->setNom($nom);
		$this->setPuisattack($puisAttack);
		$this->setType($type);
		$this->setPtlife($ptLife);

	}
	public function getNom(){
	    return $this->nom;
	}
	public function setNom($nom){
	    $this->nom = $nom;
	}

	public function getPuisattack(){
		return $this->puisAttack;
	 }
	 public function setPuisattack($puisAttack){
		$this->puisAttack = $puisAttack;
	 }

	 public function getType(){
		return $this->type;
	 }
	 public function setType($type){
		$this->type = $type;
	 }

	 public function getPtlife(){
		return $this->ptLife;
	 }
	 public function setPtlife($ptLife){
		$this->ptLife = $ptLife;
	 }

// afficher les informations du pokémon
public function pokedex(){
	echo "Nom : ".$this->getNom(). "<br>Puissance d'attaque : " .$this->getPuisattack(). "<br>Type : " .$this->getType(). "<br>Point de vie : " .$this->getPtlife(). ".<br><br><br>" ;
}

// fonction frapper
public function frapper($adversaire){
	echo $this->getNom(). ", dont le puissance d'attaque est de " .$this->getPuisattack(). " points, COMBAT ".$adversaire->getNom(). " ayant " .$adversaire->getPtlife(). " points de vie.<br>";

	$adversaire->setPtlife($adversaire->getPtlife()-$this->getPuisattack());

	echo "Désormais, ".$adversaire->getNom(). " n'a plus que " .$adversaire->getPtlife(). " points de vie. <br><br><br>";
	
	// if (($adversaire->getPtlife()-$this->getPuisattack())>0){
	// 	$adversaire->setPtlife($adversaire->getPtlife()-$this->getPuisattack());
	// 	}
		// elseif($adversaire->getPtlife()<=0){
		// 		echo "Game Over ! " .$adversaire->getNom(). " n'a pas survécu au combat contre ".$this->getNom(). ".<br><br>";
		// 	}
	if($adversaire->getPtlife()<=0){
		echo "Game Over ! " .$adversaire->getNom(). " n'a pas survécu au combat contre ".$this->getNom(). ".<br><br>";
	}
// 	while($adversaire->getPtlife()>=0){
// 	$adversaire->setPtlife($adversaire->getPtlife()-1);
// if (($adversaire->getPtlife()-$this->getPuisattack())>0){
// 	$adversaire->setPtlife($adversaire->setPtlife-$this->getPuisattack());
// 	echo $adversaire->getPtlife();
// }
// // else{
// 	// 	echo "Game Over ! " .$adversaire->getNom(). " n'a pas survécu au combat contre ".$this->getNom(). ".<br><br>";
// 	// }
// }

}

// fonction ARENE
public function arene($pokemon1,$pokemon2){
	$pokemon1->getPtlife();
	$pokemon2->getPtlife();

	echo "Combat entre : " .$this->pokemon1->getNom(). " et " .$this->pokemon2->getNom(). ".<br><br>";
}
}