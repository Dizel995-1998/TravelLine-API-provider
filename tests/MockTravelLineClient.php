<?php

namespace egik\TravellineApi;

use GuzzleHttp\Client;

class MockTravelLineClient extends TravelLineClient
{
    private function getPathToMockFile(string $url): string
    {
        $urlParts = explode('/', $url);
        array_shift($urlParts);
        return implode('_', $urlParts) . '.json';
    }

    protected function sendRequest(
        string $httpMethod,
        string $endpoint,
        array $queryParams = [],
        $requestBody = [],
        bool $throwExceptionWhenFail = true,
        int &$httpResponseCode = 0
    ): array {
        if (
            !is_array($requestBody) &&
            !is_object($requestBody)
        ) {
            throw new \InvalidArgumentException(sprintf(
                'Request body can be only array or object, %s was given',
                gettype($requestBody)
            ));
        }

        $pathToMockResponse = __DIR__ . '/MockResponses/' . $this->getPathToMockFile($endpoint);

        if (!file_exists($pathToMockResponse)) {
            throw new \RuntimeException('Cant find mock response ' . $pathToMockResponse);
        }

        $response = file_get_contents($pathToMockResponse);

        if ($response === false) {
            throw new \RuntimeException('Cant read mock file response ' . $pathToMockResponse);
        }

        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }
}