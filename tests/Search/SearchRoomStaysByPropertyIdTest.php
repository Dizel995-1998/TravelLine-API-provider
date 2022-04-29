<?php

namespace egik\TravellineApi\Search;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\ResponseDto\RoomStays\IncludedService;
use egik\TravellineApi\ResponseDto\RoomStays\Placement;
use egik\TravellineApi\ResponseDto\RoomStays\Tax;
use egik\TravellineApi\TravelLineClient;

class SearchRoomStaysByPropertyIdTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $roomStays =
            $travelLineClient->searchRoomStaysByPropertyId(
                '1',
                new \DateTimeImmutable(),
                new \DateTimeImmutable(),
                10,
                true,
            );

        $this->assertCount(1, $roomStays->getRoomStays());
        $roomStay = current($roomStays->getRoomStays());

        $this->assertEquals('YXJkdD0iMjAyMC0xMC0wNSImZGVkdD0iMjAyMC0xMC0wNyImaGFzaD0iMTI0MTJmc2ZzZGYi', $roomStay->getKey());
        $this->assertEquals('1024', $roomStay->getPropertyId());

        $roomType = $roomStay->getRoomType();
        $this->assertEquals('45687', $roomType->getId());

        // Placements
        $placements = $roomType->getPlacements();
        $this->assertCount(1, $placements);

        /**
         * @var Placement
         */
        $placement = current($placements);

        $this->assertEquals('AdultBed-2', $placement->getCode());
        $this->assertEquals(2, $placement->getCount());
        $this->assertEquals('Adult', $placement->getKind());
        $this->assertNull($placement->getMaxAge());
        $this->assertNull($placement->getMinAge());

        // guest count
        $this->assertEquals(['id' => '987657'], $roomStay->getRatePlan());
        $this->assertEquals([5], $roomStay->getGuestCount()->getChildAges());
        $this->assertEquals(1, $roomStay->getGuestCount()->getAdultCount());

        $this->assertEquals(new \DateTimeImmutable('2019-10-01T12:00'), $roomStay->getStayDates()->getArrivalDateTime());
        $this->assertEquals(new \DateTimeImmutable('2019-10-02T14:00'), $roomStay->getStayDates()->getDepartureDateTime());
        $this->assertEquals(50, $roomStay->getAvailability());
        $this->assertEquals('RUB', $roomStay->getCurrencyCode());

        $this->assertEquals(2400, $roomStay->getTotal()->getPriceBeforeTax());
        $this->assertEquals(95.5, $roomStay->getTotal()->getTaxAmount());

        // taxes
        $taxes = $roomStay->getTotal()->getTaxes();
        $this->assertCount(1, $taxes);

        /**
         * @var Tax
         */
        $tax = current($taxes);
        $this->assertEquals(95.5, $tax->getAmount());
        $this->assertEquals('Курортный сбор', $tax->getName());
        $this->assertEquals('Сбор с каждого гостя, оплата на стойке регистрации', $tax->getDescription());

        $this->assertTrue($roomStay->getCancellationPolicy()->isFreeCancellationPossible());
        $this->assertEquals(new \DateTimeImmutable('2019-09-30T12:00'), $roomStay->getCancellationPolicy()->getFreeCancellationDeadlineLocal());
        $this->assertEquals(new \DateTimeImmutable('2019-09-30T09:00Z'), $roomStay->getCancellationPolicy()->getFreeCancellationDeadlineUtc());
        $this->assertEquals(1200, $roomStay->getCancellationPolicy()->getPenaltyAmount());

        $this->assertCount(1, $roomStay->getIncludedServices());
        /**
         * @var IncludedService
         */
        $includedService = current($roomStay->getIncludedServices());

        $this->assertEquals('46545', $includedService->getId());
        $this->assertNull($includedService->getMealPlanCode());

        $this->assertEquals('RoomOnly', $roomStay->getMealPlanCode());
        $this->assertEquals('380d250cd98b256fa204477876f298f7d6bde126', $roomStay->getChecksum());
        $this->assertEquals('2 взрослых на основных местах, 1 ребёнок на дополнительном месте.', $roomStay->getFullPlacementsName());

        // todo: realize availableService
    }
}