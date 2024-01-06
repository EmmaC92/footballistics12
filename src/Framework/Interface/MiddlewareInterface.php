<?php

namespace Emmanuelc\FootballStatistic\Framework\Interface;

interface MiddlewareInterface
{
    function process(callable $next);
}
