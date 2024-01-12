<?php

namespace Emmanuelc\FootballStatistic\Framework\Controller;

use Emmanuelc\FootballStatistic\Framework\EngineTemplate;
use Emmanuelc\FootballStatistic\Framework\Utils\FootBallClient;

class HomeController
{
    public function __construct(
        private FootBallClient $client,
        private EngineTemplate $views,
    ) {
    }

    public function home()
    {
        $countries = $this->client->getCountry();

        echo $this->views->render(
            'home.php',
            [
                'countries' => $countries,
                'subTitle' => 'Home'
            ]
        );
    }
}
