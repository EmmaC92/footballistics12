<?php

namespace Emmanuelc\FootballStatistic\App\Config;

use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\Framework\Middleware\{
    TemplateDataMiddleware,
    CheckRequestCountMiddleware
};

function registerMiddleware(App $app)
{
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(CheckRequestCountMiddleware::class);
}