<?php

namespace Emmanuelc\FootballStatistic\Framework\Middleware;

use Emmanuelc\FootballStatistic\Framework\Interface\MiddlewareInterface;
use Emmanuelc\FootballStatistic\Framework\EngineTemplate;

class TemplateDataMiddleware implements MiddlewareInterface
{
    // private string const 

    public function __construct(private EngineTemplate $engineTemplate)
    {
    }
    public function process(callable $next)
    {
        $this->engineTemplate->addGlobalParameters('title', 'FootballStatistics');

        $next();
    }
}
