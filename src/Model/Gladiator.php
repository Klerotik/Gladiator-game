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

    public function attack(Gladiator $warrior2): int
    {
        $randomNumber = rand(0, 100);

        if ($randomNumber <= 10) {
            $dmg = ((2 * $this->getAttackDamage()) - $warrior2->getArmor());
            $warrior2->setHealth($warrior2->getHealth() - $dmg);
        } else {
            $dmg = ($this->getAttackDamage() - $warrior2->getArmor());
            $warrior2->setHealth($warrior2->getHealth() - $dmg);
        }


        return $dmg;
    }

    public function isDead(): bool
    {
        return $this->health <= 0;
    }
}
