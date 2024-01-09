<?php

namespace Emmanuelc\FootballStatistic\Framework\Utils;

use GuzzleHttp\Client;

class FootBallClient
{
    private Client $clientAPI;

    private const BASE_API_PATH = 'https://v3.football.api-sports.io/';

    private const TEAM_STATISTICS_ENDPOINT = 'teams/statistics';

    private const STATUS_ENDPOINT = 'status';

    private const FIXTURE_ENDPOINT = 'fixtures';

    private const ARGENTINE_LEAGUE_ID = 130;

    public function __construct()
    {
        $this->clientAPI = new Client();
    }

    public function getStatisticsByTeamAndSeason(int $teamId, string $season = null): mixed
    {
        $endpointPathUrl = $this->getEndpointBasePathUrl(self::TEAM_STATISTICS_ENDPOINT);
        $queryParams = $this->getQueryParamsForTeamAndSeason($teamId, $season);

        $url = sprintf(
            '%s?%s',
            $endpointPathUrl,
            $queryParams
        );

        return $this->request($url);
    }

    public function getFixturesByTeamAndSeason(int $teamId, string $season = null)
    {
        $endpointPathUrl = $this->getEndpointBasePathUrl(SELF::FIXTURE_ENDPOINT);
        $queryParams = $this->getQueryParamsForTeamAndSeason($teamId, $season);

        $url = sprintf(
            '%s?%s',
            $endpointPathUrl,
            $queryParams
        );

        return $this->request($url);
    }

    private function getQueryParamsForTeamAndSeason(int $teamId, string $season = null): string
    {
        return http_build_query([
            'team' => $teamId,
            'season' => $season,
            'league' => self::ARGENTINE_LEAGUE_ID
        ]);
    }

    public function getStatus(): mixed
    {
        $endpointPathUrl = $this->getEndpointBasePathUrl(self::STATUS_ENDPOINT);

        return $this->request($endpointPathUrl);
    }

    private function getEndpointBasePathUrl(string $endpointPath): string
    {
        return sprintf(
            '%s%s',
            self::BASE_API_PATH,
            $endpointPath
        );
    }

    private function request($url): mixed
    {
        if (!(bool)getenv('REQUEST_TO_API')) {
            return [];
        }

        $response = $this->clientAPI->get($url, [
            'headers' => [
                'x-apisports-key' => getenv('FOOTBALL_API_KEY'),
            ]
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        return $content['response'];
    }
}
