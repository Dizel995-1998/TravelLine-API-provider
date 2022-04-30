<?php

namespace egik\TravellineApi;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    /**
     * todo: разобраться почему не работает на protected and private
     */
    public function mockTravelLineClientDataProvider(): array
    {
        return [
            [
                new MockTravelLineClient($this->createMock(Client::class), '1111')
            ]
        ];
    }
}
