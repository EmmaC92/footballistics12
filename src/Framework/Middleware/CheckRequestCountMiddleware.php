<?php

namespace  Emmanuelc\FootballStatistic\Framework\Middleware;

use Emmanuelc\FootballStatistic\Framework\Interface\MiddlewareInterface;
use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;

class CheckRequestCountMiddleware implements MiddlewareInterface
{
    public function __construct(
        private FootBallClient $client,
        private EngineTemplate $views
    ) {
    }

    public function process(callable $next)
    {
        $status = $this->client->getStatus();

        $requestCount = '<>';
        if (!empty($status)) {
            $current = $status['requests']['current'];

            $limitDay = $status['requests']['limit_day'];

            $requestCount = $limitDay - $current;
        }

        $this->views->addGlobalParameters('requestCount', $requestCount);
        $next();
    }
}
