<?php

namespace Emmanuelc\FootballStatistic\Framework\Utils;

use Emmanuelc\FootballStatistic\App\Config\Paths;
use GuzzleHttp\Client;

class FootBallClient
{
    private Client $clientAPI;

    private const BASE_API_PATH = 'https://v3.football.api-sports.io/';
    private const TEAM_STATISTICS_ENDPOINT = 'teams/statistics';
    private const TEAMS_ENDPOINT = 'teams';
    private const STATUS_ENDPOINT = 'status';
    private const FIXTURES_ENDPOINT = 'fixtures';
    private const LEAGUES_ENDPOINT = 'leagues';
    private const ARGENTINA_COUNTRY_ID = 'Argentina';

    public function __construct()
    {
        $this->clientAPI = new Client();
    }

    public function getArgentineLeagues(): array
    {
        $url = $this->getFullUrlWithParams(self::LEAGUES_ENDPOINT, [
            'country' => self::ARGENTINA_COUNTRY_ID,
            'season' => $_GET['season'] ?? '2024',
        ]);

        return $this->request($url);
    }

    public function getArgentineLeague(int $league, int $season = 2024): array
    {
        $url = $this->getFullUrlWithParams(self::TEAMS_ENDPOINT, [
            'league' => $league,
            'season' => $season,
        ]);

        return $this->request($url);
    }

    public function getStatisticsByTeamAndSeason(int $teamId, int $season = 2024): mixed
    {
        $url = $this->getFullUrlWithParams(self::TEAM_STATISTICS_ENDPOINT, [
            'team' => $teamId,
            'season' => $season,
        ]);

        return $this->request($url);
    }

    public function getFixturesByTeamAndSeason(int $teamId, string $season = null)
    {
        $url = $this->getFullUrlWithParams(self::FIXTURES_ENDPOINT, [
            'team' => $teamId,
            'season' => $season,
        ]);

        return $this->request($url);
    }

    private function getFullUrlWithParams(string $endpoint, array $params = []): string
    {
        $endpointPathUrl = $this->getEndpointBasePathUrl($endpoint);
        $queryParams = $this->getQueryParamsForEndpoint($params);

        return sprintf(
            '%s?%s',
            $endpointPathUrl,
            $queryParams
        );
    }

    private function getQueryParamsForEndpoint(array $params): string
    {
        return http_build_query($params);
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

    private function request(string $url): mixed
    {
        if (!(bool)getenv('REQUEST_TO_API')) {
            return $this->checkAndRetrieveApiData($url);
        }

        $response = $this->clientAPI->get($url, [
            'headers' => [
                'x-apisports-key' => getenv('FOOTBALL_API_KEY'),
            ]
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        $this->createFileIntoApiData($url, $content);

        return $content['response'];
    }

    private function checkAndRetrieveApiData(string $url): array
    {
        $endpoint = str_replace(self::BASE_API_PATH, '', $url);
        $file = Paths::API_DATA . "/$endpoint.json";
        if (file_exists($file)) {

            $content = json_decode(file_get_contents($file), true);

            return $content['response'];
        }
        return [];
    }

    private function createFileIntoApiData(string $url, array $content): void
    {
        $endpoint = str_replace(self::BASE_API_PATH, '', $url);
        $file = Paths::API_DATA . "/$endpoint.json";
        file_put_contents($file, json_encode($content));
    }
}
