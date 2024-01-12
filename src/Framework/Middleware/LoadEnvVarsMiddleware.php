<?php

namespace Emmanuelc\FootballStatistic\Framework\Middleware;

use Emmanuelc\FootballStatistic\Framework\Interface\MiddlewareInterface;
use Emmanuelc\FootballStatistic\App\Config\Paths;
use \Dotenv\Dotenv;

class LoadEnvVarsMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        Dotenv::createUnsafeImmutable(Paths::ENV_PATH)->load();
        $next();
    }
}
