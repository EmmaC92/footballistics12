<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework\Middleware;

use Emmanuelc\FootballStatistic\Framework\Interface\MiddlewareInterface;
use Emmanuelc\FootballStatistic\Framework\Exception\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $_SESSION['errors'] = $e->errors;
            $referer = $_SERVER['HTTP_REFERER'] ?? '/';

            $this->redirecTo($referer);
        }
    }

    private function redirecTo(string $path)
    {
        header("Location: $path");
        http_response_code(302);
        exit;
    }
}
