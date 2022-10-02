<?php declare(strict_types=1);

namespace Game\Model;

class Gladiator
{
    private string $name;
    private int $attackDamage;
    private int $armor;
    private int $health;

    public function __construct(string $name, int $attackDamage, int $armor, int $health)
    {
        $this->name = $name;
        $this->attackDamage = $attackDamage;
        $this->armor = $armor;
        $this->health = $health;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAttackDamage(): int
    {
        return $this->attackDamage;
    }

    public function setAttackDamage(int $attackDamage): void
    {
        $this->attackDamage = $attackDamage;
    }

    public function getArmor(): int
    {
        return $this->armor;
    }

    public function setArmor(int $armor): void
    {
        $this->armor = $armor;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * Vzhledem k tomu, že krom násobení attackDamage jsou obě klausule if/else stejné, pojďme kód rafaktorovat
     * využitím proměnné $multiplier.
     *
     * Po implementaci si všimneš, že v if/else jen definuješ hodnotu proměnné $multiplier,
     * můžeš proto zápis zkrátit přes ternární operátor.
     *
     * Also: random výběr jednoho čísla z 10ti (0 - 9) je taky pravěpodobnost 10%.
     * Využij tohoto a faktu že 0 = false a jakékoli jiné číslo = true v ternárním operátoru a
     * měl bys dostat popiči elegantní
     *
     * Ternární operátor = (Condition) ? (Statement1) : (Statement2);
     * OK
     */
    public function attack(Gladiator $warrior2): int
    {
        $multiplier = 2;

        $dmg = rand(0,9) ? ($this->getAttackDamage() - $warrior2->getArmor()) : ($multiplier * $this->getAttackDamage() - $warrior2->getArmor());
        $warrior2->setHealth($warrior2->getHealth() - $dmg);

        return $dmg;
    }

    public function isDead(): bool
    {
        return $this->health <= 0;
    }
}
