<?php declare(strict_types=1);

namespace Game\Model;

use Symfony\Component\Console\Output\OutputInterface;

class Messenger
{

    private OutputInterface $output;

    public static function roundMessage($warrior1, $warrior2, $dmg): void
    {
        print("{$warrior1->getName()} hit {$warrior2->getName()} for {$dmg}, leaving him with {$warrior2->getHealth()} HP.\n");

    }

    public static function gameWin($warrior1): void
    {
        print("{$warrior1->getName()} wins!");
    }

    public static function gameTie($warrior1, $warrior2): void
    {
        print("{$warrior1->getName()} was left with {$warrior1->getHealth()}. {$warrior2->getName()} was left with {$warrior2->getHealth()} Nobody wins! The game was a tie!");
    }

}