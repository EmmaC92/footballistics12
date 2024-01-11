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

    public function leagues()
    {
        $leagues = $this->footballClient->getArgentineLeagues();
        $countries = $this->footballClient->getCountry();

        echo $this->views->render(
            'League/leagues.php',
            [
                'subTitle' => 'All leagues',
                'leagues' => $leagues,
                'countries' => $countries
            ]
        );
    }

    public function league()
    {
        $leagueId = $_POST['league'];
        $season = $_POST['season'];

        $league = $this->footballClient->getArgentineLeague($leagueId, $season);
        echo $this->views->render(
            'League/league.php',
            [
                'subTitle' => 'League',
                'league' => $league,
                'season' => $season
            ]
        );
    }
}
