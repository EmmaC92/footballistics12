<?php

namespace Emmanuelc\FootballStatistic\App\Config;

use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\Framework\Controller\{
    HomeController,
    FixtureController,
    LeagueController
};

class Routes
{
    public static function addRoutes(App $app)
    {
        $app->get('/', [HomeController::class, 'home']);
        $app->post('/league', [LeagueController::class, 'league']);
        $app->post('/leagues', [LeagueController::class, 'leagues']);
        $app->get('/fixture', [FixtureController::class, 'fixture']);
    }
}
