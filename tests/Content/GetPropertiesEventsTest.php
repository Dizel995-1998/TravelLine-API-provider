<?php

namespace egik\TravellineApi\Content;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\TravelLineClient;

class GetPropertiesEventsTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $eventsResult = $travelLineClient->getPropertiesEvents();
        $this->assertCount(1, $eventsResult->getEvents());

        foreach ($eventsResult->getEvents() as $event) {
            $this->assertEquals(new \DateTimeImmutable('2019-06-20T10:41:04Z'), $event->getCreated());
            $this->assertEquals('1024', $event->getPropertyId());
            $this->assertEquals('Added', $event->getEventType());
        }

        $this->assertFalse($eventsResult->isHasMoreData());
    }
}
