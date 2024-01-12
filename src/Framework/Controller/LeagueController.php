<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework\Controller;

use Emmanuelc\FootballStatistic\Framework\EngineTemplate;
use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;
use Emmanuelc\FootballStatistic\App\Services\ValidatorService;

class LeagueController
{
    public function __construct(
        private EngineTemplate $view,
        private ValidatorService $validator,
        private FootBallClient $footballClient,
    ) {
    }

    public function leagues()
    {
        $this->validator->validateLeagues($_POST);
        $season = $_POST['season'];
        $country = $_POST['country'];
        $_SESSION['season'] = $season;
        $leagues = $this->footballClient->getLeagues($country, $season);
        $countries = $this->footballClient->getCountry();

        echo $this->view->render(
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
        $leagueId = (int) $_POST['league'];
        $season = (int) $_SESSION['season'];
        $league = $this->footballClient->getTeamsByLeague($leagueId, $season);
        echo $this->view->render(
            'League/league.php',
            [
                'subTitle' => 'League',
                'league' => $league,
                'season' => $season
            ]
        );
    }
}
