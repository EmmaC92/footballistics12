<?php

require __DIR__ . "/../../vendor/autoload.php";

use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\App\Config\{
    Routes,
    Paths
};
use function Emmanuelc\FootballStatistic\App\Config\{
    registerMiddleware
};

$app = new App(Paths::SOURCE_PATH . "src/App/container-definition.php");
Routes::addRoutes($app);
registerMiddleware($app);

return $app;
