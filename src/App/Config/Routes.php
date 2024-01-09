<?php

namespace Emmanuelc\FootballStatistic\App\Config;

use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\Framework\Controller\{
    HomeController,
    FixtureController
};

class Routes
{
    public static function addRoutes(App $app)
    {
        $app->get('/', [HomeController::class, 'index']);
        $app->get('/fixture/', [FixtureController::class, 'fixture']);
    }
}
