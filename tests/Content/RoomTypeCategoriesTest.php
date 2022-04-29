<?php

namespace egik\TravellineApi\Content;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\TravelLineClient;

class RoomTypeCategoriesTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $roomTypeCategories = $travelLineClient->getRoomTypeCategories();
        $this->assertCount(1, $roomTypeCategories);

        $roomTypeCategory = current($roomTypeCategories);

        $this->assertEquals('PlaceInRoom', $roomTypeCategory->getCode());
        $this->assertEquals('Место в номере', $roomTypeCategory->getName());
    }
}
