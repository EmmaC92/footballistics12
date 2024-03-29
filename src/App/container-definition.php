<?php

declare(strict_types=1);

use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;
use Emmanuelc\FootballStatistic\App\Config\Paths;
use Emmanuelc\FootballStatistic\App\Services\ValidatorService;

return [
    FootBallClient::class => fn () => new FootBallClient(),
    EngineTemplate::class => fn () => new EngineTemplate(Paths::VIEWS_PATH),
    ValidatorService::class => fn () => new ValidatorService(),
];
