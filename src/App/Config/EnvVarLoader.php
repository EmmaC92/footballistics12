<?php

namespace Emmanuelc\FootballStatistic\App\Config;
use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\App\Config\Paths;

function loadEnvVars(App $app)
{
    $app->loadEnvVars(Paths::ENV_PATH);
}