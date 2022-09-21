<?php declare(strict_types = 1);

namespace Game;

use Game\Model\Game;
use Game\Model\Gladiator;
use http\Exception\RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

final class RunGameCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('game:run');
        $this->setDescription('Execute this command to start a game.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $warrior1 = new Gladiator("Matty", 20, 5, 100);
        $warrior2 = new Gladiator("Grabby", 15, 10, 100);


        $output->writeln("Welcome to Matty vs. Grabby!");
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Would you like to set the attributes of the Gladiators? Press 0 for NO, press 1 YES',
            ['0', '1'],
            '0');

        $question->setErrorMessage('Hey, I said 0 or 1. Be cool man.');

        $choise = $helper->ask($input, $output, $question);
        $output->writeln('You have selected: '.$choise);

        if ($choise == 1) {

            $helper = $this->getHelper('question');
            $questionHealth = new Question('Please input how much health should the Gladiators have = ');

            $questionHealth->setValidator(function ($answer) {
                if (!is_numeric($answer)) {
                    throw new RuntimeException('Health should be an integer.');
                }
                return $answer;
            });

            $healthPoints = (int)$helper->ask($input, $output, $questionHealth);

            $resultHealth = $warrior1->setHealth($healthPoints);
            $resultHealth = $warrior2->setHealth($healthPoints);

            $helper = $this->getHelper('question');
            $questionAttackDamage = new Question('Please input how much attack damage should the Gladiators have = ');

            $questionAttackDamage->setValidator(function ($answer) {
                if (!is_numeric($answer)) {
                    throw new RuntimeException('Attack damage should be an integer.');
                }
                return $answer;
            });

            $attackDamage = (int)$helper->ask($input, $output, $questionAttackDamage);

            $resultAttackDamage = $warrior1->setAttackDamage($attackDamage);
            $resultAttackDamage = $warrior2->setAttackDamage($attackDamage);

            $helper = $this->getHelper('question');
            $questionArmor = new Question('Please input how much armor should the Gladiators have = ');

            $questionArmor->setValidator(function ($answer) {
                if (!is_numeric($answer)) {
                    throw new RuntimeException('Armor should be an integer.');
                }
                return $answer;
            });

            $armor = (int)$helper->ask($input, $output, $questionArmor);

            $resultArmor = $warrior1->setArmor($armor);
            $resultArmor = $warrior2->setArmor($armor);
        }

        $game = new Game($warrior1, $warrior2, 10, $output);
        $game->run();

        return 0;
    }
}
