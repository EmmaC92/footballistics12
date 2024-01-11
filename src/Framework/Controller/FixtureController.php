<?php

namespace Emmanuelc\FootballStatistic\Framework\Controller;

use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;

class FixtureController
{

    public function __construct(
        private FootBallClient $footballClient,
        private EngineTemplate $views
    ) {
    }

    public function fixture()
    {
        $teamId = (int)$_GET['teamId'];
        $season = (string)$_GET['season'];
        $fixtures = $this->footballClient->getFixturesByTeamAndSeason($teamId, $season);

        $fixtures = array_reverse($fixtures);

        echo $this->views->render(
            'Fixture/fixture.php',
            [
                'subTitle' => 'Fixture',
                'fixtures' => $fixtures
            ]
        );
    }
}
