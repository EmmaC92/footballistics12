<?php

declare(strict_types=1);

use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;
use Emmanuelc\FootballStatistic\App\Config\Paths;

return [
    FootBallClient::class => fn () => new FootBallClient(),
    EngineTemplate::class => fn () => new EngineTemplate(Paths::VIEWS_PATH)
];
