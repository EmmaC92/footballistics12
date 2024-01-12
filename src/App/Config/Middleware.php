<?php

namespace Emmanuelc\FootballStatistic\App\Config;

use Emmanuelc\FootballStatistic\Framework\App;
use Emmanuelc\FootballStatistic\Framework\Middleware\{
    TemplateDataMiddleware,
    CheckRequestCountMiddleware,
    LoadEnvVarsMiddleware,
    ValidationExceptionMiddleware,
    SessionMiddleware,
    FlashMiddleware
};

function registerMiddleware(App $app)
{
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(CheckRequestCountMiddleware::class);
    $app->addMiddleware(LoadEnvVarsMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);
}