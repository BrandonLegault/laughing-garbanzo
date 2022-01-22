<!DOCTYPE html>
    <html>
    <head>
        <style>
            li {
                list-style-type: none;
                margin-bottom: 1em;
            }
            span {
                display: block;
            }
        </style>
    </head>
    <body>
    <div>
        <span class="title">Current Players</span>
        <ul>
            <?php foreach($players as $player) { ?>
                <li>
                    <div>
                        <span class="player-name">Name: <?= $player->getName(); ?></span>
                        <span class="player-age">Age: <?= $player->getAge(); ?></span>
                        <span class="player-salary">Salary: <?= $player->getSalary(); ?></span>
                        <span class="player-job">Job: <?= $player->getJob(); ?></span>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </body>
</html>