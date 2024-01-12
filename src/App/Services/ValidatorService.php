<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\App\Services;

use Emmanuelc\FootballStatistic\Framework\Validator;
use Emmanuelc\FootballStatistic\Framework\Rules\{
    RequiredRule
};

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->validator->add('required', new RequiredRule());
    }

    public function validateLeagues(array $formDate)
    {
        $this->validator->validate($formDate, [
            'season' => ['required'],
            'country' => ['required']
        ]);
    }
}
