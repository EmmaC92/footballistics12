<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework\Interface;

interface RuleInterface
{
    public function validate(array $data, string $field, array $params): bool;
    public function getMessage(array $data, string $field, array $params): string;
}
