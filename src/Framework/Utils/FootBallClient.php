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
    private const COUNTRIES_ENDPOINT = 'countries';

    private const ARGENTINA_COUNTRY_ID = 'Argentina';

    public function __construct()
    {
        $this->clientAPI = new Client();
    }

    public function getLeagues(string $country, string $season): array
    {
        $url = $this->getFullUrlWithParams(self::LEAGUES_ENDPOINT, [
            'country' => $country,
            'season' => $season,
        ]);

        return $this->request($url);
    }

    public function getCountry(): array
    {
        $url = $this->getFullUrlWithParams(self::COUNTRIES_ENDPOINT);
        return $this->request($url);
    }


    public function getTeamsByLeague(int $league, int $season = 2024): array
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

        if (!empty($params)) {
            $queryParams = $this->getQueryParamsForEndpoint($params);

            $endpointPathUrl = sprintf(
                '%s?%s',
                $endpointPathUrl,
                $queryParams
            );
        }

        return $endpointPathUrl;
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
        if ($this->checkFileApiData($url)) {
            return $this->retrieveContentApiData($url);
        }

        if (!(bool)getenv('REQUEST_TO_API')) {
            return [];
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

    private function getFileNameFromUrl(string $url): string
    {
        $endpoint = str_replace(self::BASE_API_PATH, '', $url);
        return Paths::API_DATA . "/$endpoint.json";
    }

    private function checkFileApiData(string $url): bool
    {
        $file = $this->getFileNameFromUrl($url);
        return file_exists($file);
    }

    private function retrieveContentApiData(string $url): array
    {
        $file = $this->getFileNameFromUrl($url);
        $content = json_decode(file_get_contents($file), true);

        return $content['response'];
    }

    private function createFileIntoApiData(string $url, array $content): void
    {
        $endpoint = str_replace(self::BASE_API_PATH, '', $url);
        $file = Paths::API_DATA . "/$endpoint.json";
        file_put_contents($file, json_encode($content));
    }
}
