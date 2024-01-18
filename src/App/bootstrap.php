<?php

require __DIR__ . '/../../vendor/autoload.php';

use function Emmanuelc\FootballStatistic\App\Config\registerMiddleware;

use Dotenv\Dotenv;
use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\App\Config\{
    Routes,
    Paths
};

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$app = new App(Paths::SOURCE_PATH . 'src/App/container-definition.php');
Routes::addRoutes($app);
registerMiddleware($app);

return $app;
