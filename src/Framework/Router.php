<?php

namespace Emmanuelc\FootballStatistic\Framework;

use Emmanuelc\FootballStatistic\Framework\Container;

class Router
{
    private array $routes = [];

    private array $middlewares = [];

    public function addRoute(string $method, string $path, array $controller): void
    {
        $path = $this->serializePath($path);
        $this->routes[] = [
            "method" => strtoupper($method),
            "path" => $path,
            "controller" => $controller
        ];
    }

    public function addMiddleware(string $middlewareClass): void
    {
        $this->middlewares[] = $middlewareClass;
    }

    private function serializePath($path): string
    {
        $path = trim($path, '/');
        $path = "/$path/";
        return preg_replace("#[/]{2,}#", $path, '/');
    }

    public function dispatch(string $method, string $path, Container $container = null): void
    {
        $method = strtoupper($method);
        $path = $this->serializePath($path);

        foreach ($this->routes as $route) {

            if ($route['path'] !== $path && $route['method'] !== $method) {
                continue;
            }

            [$controllerClass, $function] = $route['controller'];

            $controller = $container ? $container->resolve($controllerClass) : new $controllerClass();

            $action = fn () => $controller->$function();

            foreach ($this->middlewares as $middleware) {
                $middlewareAction = $container ? $container->resolve($middleware) : new $middleware();
                $action = fn () => $middlewareAction->process($action);
            }

            $action();
            return;
        }
    }
}
