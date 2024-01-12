<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework\Middleware;

use Emmanuelc\FootballStatistic\Framework\Interface\MiddlewareInterface;
use Emmanuelc\FootballStatistic\App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already active.");
        }

        if (headers_sent($fileName, $line)) {
            throw new SessionException("Headers already sent. consider enablig output buffering. Data outputted from {$fileName} - Line {$line}");
        }

        session_start();

        $next();

        session_write_close();
    }
}
