<?php

namespace Emmanuelc\FootballStatistic\Framework\Controller;

use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;

class HomeController
{
    public function __construct(
        private FootBallClient $footballClient,
        private EngineTemplate $views
    ) {
    }

    public function index()
    { 
        $bocaJrsId = 451;
        $fixture = $this->footballClient->getStatisticsByTeamAndSeason($bocaJrsId, '2022');

        echo $this->views->render(
            'home.php',
            [
                'title' => 'FootBallStatistics | Home',
            ]
        );
    }
}
