<?php

namespace Emmanuelc\FootballStatistic\Framework\Interface;

interface MiddlewareInterface
{
    function process(callable $next);

    const string TESTING = [
        'first' => 1,
        'second' => 2,
        'third' => 3
    ];
}
