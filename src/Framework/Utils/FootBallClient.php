<?php

namespace Emmanuelc\FootballStatistic\Framework\Utils;

use GuzzleHttp\Client;

class FootBallClient
{
    private Client $clientAPI;

    private const BASE_API_PATH = 'https://v3.football.api-sports.io/';

    private const TEAM_STATISTICS = 'teams/statistics';

    private const FIXTURE = 'fixture';

    private const ARGENTINE_LEAGUE_ID = 130;

    public function __construct()
    {
        $this->clientAPI = new Client();
    }

    public function getStatisticsByTeamAndSeason(int $teamId, string $season = null): mixed
    {
        $queryParams = $this->getQueryParamsForTeamAndSeason($teamId, $season);

        $url = sprintf(
            '%s%s?%s',
            self::BASE_API_PATH,
            self::TEAM_STATISTICS,
            $queryParams
        );

        if (!(bool)getenv('REQUEST_TO_API')) {
            return [];
        }

        $response = $this->clientAPI->get($url, [
            'headers' => [
                'x-apisports-key' => getenv('FOOTBALL_API_KEY'),
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    private function getQueryParamsForTeamAndSeason(int $teamId, string $season = null): string
    {
        return http_build_query([
            'team' => $teamId,
            'season' => $season,
            'league' => self::ARGENTINE_LEAGUE_ID
        ]);
    }
}
