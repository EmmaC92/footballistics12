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
        $bocaJrsId = 451;
        $fixtures = $this->footballClient->getFixturesByTeamAndSeason($bocaJrsId, '2020');

        echo $this->views->render(
            'Fixture/fixture.php',
            [
                'subTitle' => 'Fixture',
                'fixtures' => $fixtures
            ]
        );
    }
}
