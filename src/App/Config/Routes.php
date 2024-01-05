<?php

namespace Emmanuelc\FootballStatistic\App\Config;

use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\Framework\Controller\HomeController;

class Routes
{
    public static function addRoutes(App $app)
    {
        $app->get('/', [HomeController::class, 'index']);
    }
}
