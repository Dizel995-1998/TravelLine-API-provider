<?php

namespace egik\TravellineApi;

use egik\TravellineApi\Exception\TravelLineInvalidResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ValidateTest extends TestCase
{
    public function httpMockClientDataProvider(): array
    {
        return [
            [
                $this->createMock(Client::class),
            ]
        ];
    }

    /**
     * @dataProvider httpMockClientDataProvider
     */
    public function testFailure(MockObject $httpFakeClient): void
    {
        $mockResponse = [
            'hasMoreData' => 1111,
            'events' => [
                [
                    'created' => 2222222,
                    'propertyId' => 1111,
                    'eventType' => 3333,
                ]
            ],
        ];

        $httpFakeClient
            ->method('request')
            ->willReturn(new Response(200, [], json_encode($mockResponse)));

        /**
         * @var Client $httpFakeClient
         */
        $travelLineClient = new TravelLineClient($httpFakeClient, '11111');

        $this->expectException(TravelLineInvalidResponseException::class);
        $travelLineClient->getPropertiesEvents();
    }

//    public function testSuccess(): void
//    {
//
//    }
}