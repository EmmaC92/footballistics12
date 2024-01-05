<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework;
use Emmanuelc\FootballStatistic\Framework\Router;
use Emmanuelc\FootballStatistic\Framework\Container;

class App
{
    private Router $router;

    private Container $container;

    public function __construct(string $definitionPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($definitionPath) {
            $definitionArray = include $definitionPath;
            $this->container->addDefinitions($definitionArray);
        }
    }

    public function get(string $path, array $controller): void
    {
        $this->router->addRoute('GET', $path, $controller);
    }

    public function addMiddleware(string $middlewareClass)
    {
        $this->router->addMiddleware($middlewareClass);
    }

    public function loadEnvVars(string $path)
    {
        \Dotenv\Dotenv::createUnsafeImmutable($path)->load();
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }
}
