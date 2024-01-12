<?php

namespace Emmanuelc\FootballStatistic\Framework\Middleware;

use Emmanuelc\FootballStatistic\Framework\Interface\MiddlewareInterface;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;

class FlashMiddleware implements MiddlewareInterface
{
    public function __construct(private EngineTemplate $view)
    {
    }

    public function process(callable $next)
    {
        $this->view->addGlobalParameters('errors', $_SESSION['errors'] ?? []);

        unset($_SESSION['errors']);

        $next();
    }
}
