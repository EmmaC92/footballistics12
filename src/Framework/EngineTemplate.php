<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework;

class EngineTemplate
{
    private $globalParameters = [];

    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function addGlobalParameters($key, $value)
    {
        $this->globalParameters[$key] = $value;
    }

    public function render($template, array $parameters = [])
    {
        extract($parameters, EXTR_SKIP);
        extract($this->globalParameters, EXTR_SKIP);

        ob_start();

        include $this->resolvePath($template);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    public function resolvePath($path): string
    {
        return "{$this->basePath}/$path";
    }
}
