<?php
class Pokemon {
    private string $nom;
    private int $puissanceAttaque;
    private string $type;
    private int $pointsDeVie;

    public function __construct(string $nom, int $puissanceAttaque, string $type, int $pointsDeVie) {
        $this->nom = $nom;
        $this->puissanceAttaque = $puissanceAttaque;
        $this->type = $type;
        $this->pointsDeVie = $pointsDeVie;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function isAlive(): bool {
        return $this->pointsDeVie > 0;
    }

    public function attaquer(Pokemon $cible): void {
        if ($this->pointsDeVie <= 0) {
            echo $this->nom . " est KO et ne peut pas attaquer !" . PHP_EOL;
            return;
        }

        echo $this->nom . " attaque " . $cible->getNom() . " et inflige " . $this->puissanceAttaque . " dégâts !" . PHP_EOL;
        $cible->recevoirDegats($this->puissanceAttaque);
    }

    public function recevoirDegats(int $degats): void {
        $this->pointsDeVie -= $degats;

        if ($this->pointsDeVie <= 0) {
            $this->pointsDeVie = 0;
            echo $this->nom . " est KO !" . PHP_EOL;
        } else {
            echo $this->nom . " a maintenant " . $this->pointsDeVie . " points de vie." . PHP_EOL;
        }
    }
}

// Créer les Pokémon
$pikachu = new Pokemon("Pikachu", 55, "Électrique", 100);
$carapuce = new Pokemon("Carapuce", 50, "Eau", 110);

// Combat aléatoire
echo "Début du combat entre " . $pikachu->getNom() . " et " . $carapuce->getNom() . " !" . PHP_EOL;

while ($pikachu->isAlive() && $carapuce->isAlive()) {
    // Choix aléatoire du Pokémon qui attaque
    $attacker = rand(0, 1) === 0 ? $pikachu : $carapuce;
    $defender = $attacker === $pikachu ? $carapuce : $pikachu;

    // L'attaquant attaque le défenseur
    $attacker->attaquer($defender);

    // Vérifie si le défenseur est KO
    if (!$defender->isAlive()) {
        echo $defender->getNom() . " est KO ! " . $attacker->getNom() . " remporte le combat !" . PHP_EOL;
        break;
    }

    echo PHP_EOL; // Ligne vide pour séparer les tours
}
?>
