<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework\Rules;

use Emmanuelc\FootballStatistic\Framework\Interface\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return !empty($data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "This field is required.";
    }
}
