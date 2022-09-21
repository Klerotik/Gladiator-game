# Gladiator game test

Gladiator game PHP test, based on popular web games like gladiatus, shakes and fidget etc.

## How to run application
Clone this repo, inside the repo
```
php composer install
php run.php game:run
```

## Rules and acceptance criteria
This repository consists of 3 main components.

1. [RunGameCommand](src/RunGameCommand.php) - should create instance `Game`,its dependencies and then start it.
2. [Game](src/Model/Game.php) - should perform all the logic in the game (rounds, attacks etc.).
3. [Gladiator](src/Model/Gladiator.php) - should hold information about its health and other stats.

Tasks:
1. Gladiator should fight each other to death or until end of rounds, if Gladiators live, game should end with draw.
2. Game needs to take in account attack damage, health and armor (more armor should result in less damage taken), how stats interact with each other is completely up to you.
3. Implement some sort of luck, for example each gladiator has each round chance to double strike, or implement critical strike chance, can be also something completely different.
4. Game prints out information about what is happening each round using `OutputInterface`, output will be the whole visualisation of the game so make it pretty.
5. Commit your implementation into git, check if it really runs.
6. Have fun.


Extra tasks if you would be bored and felt strong:
1. Persist data about the game, for example into file or some sort of database.
2. Push your final repository on some public git repository provider ([Github](https://github.com)/[Gitlab](https://gitlab.com)/[Bitbucket](https://bitbucket.org))
3. Find a way to set attributes for warriors using symfony interactive console, [this](https://symfony.com/doc/current/console.html#console-input) could help.


