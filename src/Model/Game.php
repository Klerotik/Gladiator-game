<?php declare(strict_types = 1);

namespace Game\Model;

use Symfony\Component\Console\Output\OutputInterface;

class Game
{
    private Gladiator $warrior1;
    private Gladiator $warrior2;
    private int $numberOfRounds;
    private OutputInterface $output;

    public function __construct(Gladiator $warrior1, Gladiator $warrior2, int $numberOfRounds, OutputInterface $output)
    {
        $this->warrior1 = $warrior1;
        $this->warrior2 = $warrior2;
        $this->numberOfRounds = $numberOfRounds;
        $this->output = $output;
    }

    public function run(): void
    {
        /**
         * Nepotřebujeme proměnou $starting, když změníme rand na 0-1 místo 1-2 a vložíme rovnou do ifu
         * Taky nepotřebujeme else, když bude
         * $warrior1 = $this->warrior1 a $warrior2 = $this->warrior2; jako defaultní stav
         **/
        $starting = rand(1,2);
        if ($starting == 1) {
            $warrior1 = $this->warrior1;
            $warrior2 = $this->warrior2;
        } else {
            $warrior1 = $this->warrior2;
            $warrior2 = $this->warrior1;
        }

        $decisiveMatch = false;

        /**
         *  Zde si taky můžeme všimnout, že je kód duplicitní, jen se mění kdo útočí na koho...
         *  Pojďme toto hodit do funkce playRound s parametry $attacker a $target... jebat $i
         *
         *  Protože nejde breaknout cyklus z vnořené funkce, budeme muset vratec $target->isDead()
         *  Té duplicitě se nevyhneme, ale aspoň nebude vypadat tak strašně
         */
        for ($i = 0; $i < $this->numberOfRounds; $i++) {
            $dmg = $warrior1->attack($warrior2);

            /**
             * Byť je generování stringů pro output technicky správně, vypadá to strašně...
             * Vytvoř novou classu Messenger se statickými metodami, které budou generovat stringy.
             * npř. Messenger::roundMessage($warrior1, $warrior2, $damage);
             * Využij "string literals", ať nemusíš používat tečky
             * tedy "{$warrior1->getName()} hits {$warrior2->getName()}..." atd. atd. udělej to pro všechny message v téhle tříde.
             */
            $this->output->writeln($warrior1->getName()." hit ".$warrior2->getName()." for ".$dmg.", leaving him with ".$warrior2->getHealth()." HP.");
            if ($warrior2->isDead()) {
                $this->output->writeln($warrior1->getName()." wins!");
                $decisiveMatch = true;
                break;
            }

            sleep(1);

            $dmg = $warrior2->attack($warrior1);
            $this->output->writeln($warrior2->getName()." hit ".$warrior1->getName()." for ".$dmg.", leaving him with ".$warrior1->getHealth()." HP.");
            if ($warrior1->isDead()) {
                $this->output->writeln($warrior2->getName()." wins!");
                $decisiveMatch = true;
                break;
            }

            sleep(1);
        }

        if ($decisiveMatch === false) {
            $this->output->writeln("The game was a tie!");
        }
    }

    private function playRound(int $i): void
    {
    }
}
