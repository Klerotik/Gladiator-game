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

        $warrior1 = $this->warrior1;
        $warrior2 = $this->warrior2;


        //Stačí ten if jenom takhle bez nasetování defaultních warriorů o 2 řádky výš?
        if (rand(0,1)){
            $warrior1 = $this->warrior2;
            $warrior2 = $this->warrior1;
        }



        /**
         *  Zde si taky můžeme všimnout, že je kód duplicitní, jen se mění kdo útočí na koho...
         *  Pojďme toto hodit do funkce playRound s parametry $attacker a $target... jebat $i
         *
         *  Protože nejde breaknout cyklus z vnořené funkce, budeme muset vratec $target->isDead()
         *  Té duplicitě se nevyhneme, ale aspoň nebude vypadat tak strašně
         */
        $decisiveMatch = false;
        for ($i = 0; $i < $this->numberOfRounds; $i++) {
            if ($this->playRound($warrior1, $warrior2)) {
                $decisiveMatch = true;
                break;
            }
            sleep(1);

            if ($this->playRound($warrior2, $warrior1)) {
                $decisiveMatch = true;
                break;
            }
            sleep(1);

            //Ta remíza nefunguje, buď se neukáže vůbec, a nebo se opakuje každé kolo v tom for loopu. Přitom je napsaná stejně jako v předchozí verzi.
            if ($decisiveMatch === false) {
                Messenger::gameTie($warrior1, $warrior2);
            }
        }}

            /**
             * Byť je generování stringů pro output technicky správně, vypadá to strašně...
             * Vytvoř novou classu Messenger se statickými metodami, které budou generovat stringy.
             * npř. Messenger::roundMessage($warrior1, $warrior2, $damage);
             * Využij "string literals", ať nemusíš používat tečky
             * tedy "{$warrior1->getName()} hits {$warrior2->getName()}..." atd. atd. udělej to pro všechny message v téhle tříde.
             */



    private function playRound($attacker, $target): bool
    {
        $dmg = $attacker->attack($target);
        Messenger::roundMessage($attacker, $target, $dmg);
        if ($target->isDead()){
            Messenger::gameWin($attacker);
        }
        return $target->isDead();
    }
}

