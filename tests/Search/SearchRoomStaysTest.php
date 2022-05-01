<?php

namespace egik\TravellineApi\Search;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\BookingPersonContacts;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\Customer;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingGuestCount;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingRatePlan;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingRoomStay;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingRoomType;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingStayDates;
use egik\TravellineApi\RequestDto\Reservation\Verify\VerifyBookingRequest;
use egik\TravellineApi\RequestDto\Search\RoomStays\RoomStays;
use egik\TravellineApi\TravelLineClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class SearchRoomStaysTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $roomStays = $travelLineClient->searchRoomStays(
            new RoomStays(1, new \DateTimeImmutable('-1 day'), new \DateTimeImmutable())
        );

        // Room stay
        $this->assertCount(1, $roomStays->getRoomStays());

        foreach ($roomStays->getRoomStays() as $roomStay) {
            $this->assertEquals('YXJkdD0iMjAyMC0xMC0wNSImZGVkdD0iMjAyMC0xMC0wNyImaGFzaD0iMTI0MTJmc2ZzZGYi', $roomStay->getKey());
            $this->assertEquals('1024', $roomStay->getPropertyId());
            $this->assertEquals(50, $roomStay->getAvailability());
            $this->assertEquals('RUB', $roomStay->getCurrencyCode());
            $this->assertEquals('45687', $roomStay->getRoomType()->getId());
            $this->assertCount(1, $roomStay->getRoomType()->getPlacements());

            foreach ($roomStay->getRoomType()->getPlacements() as $placement) {
                $this->assertEquals('AdultBed-2', $placement->getCode());
                $this->assertEquals(2, $placement->getCount());
                $this->assertEquals('Adult', $placement->getKind());
                $this->assertEquals(null, $placement->getMaxAge());
                $this->assertEquals(null, $placement->getMaxAge());
            }

            $this->assertEquals(['id' => '987657'], $roomStay->getRatePlan());
            $this->assertEquals(1, $roomStay->getGuestCount()->getAdultCount());
            $this->assertEquals([5], $roomStay->getGuestCount()->getChildAges());

            $this->assertEquals(new \DateTimeImmutable('2019-10-01T12:00'), $roomStay->getStayDates()->getArrivalDateTime());
            $this->assertEquals(new \DateTimeImmutable('2019-10-02T14:00'), $roomStay->getStayDates()->getDepartureDateTime());

            $this->assertEquals(2400, $roomStay->getTotal()->getPriceBeforeTax());
            $this->assertEquals(95.5, $roomStay->getTotal()->getTaxAmount());
            $this->assertCount(1, $roomStay->getTotal()->getTaxes());

            foreach ($roomStay->getTotal()->getTaxes() as $tax) {
                $this->assertEquals(95.5, $tax->getAmount());
                $this->assertEquals('Курортный сбор', $tax->getName());
                $this->assertEquals('Сбор с каждого гостя, оплата на стойке регистрации', $tax->getDescription());
            }

            $this->assertEquals(true, $roomStay->getCancellationPolicy()->isFreeCancellationPossible());
            $this->assertEquals(new \DateTimeImmutable('2019-09-30T12:00'), $roomStay->getCancellationPolicy()->getFreeCancellationDeadlineLocal());
            $this->assertEquals(new \DateTimeImmutable('2019-09-30T09:00Z'), $roomStay->getCancellationPolicy()->getFreeCancellationDeadlineUtc());
            $this->assertEquals(1200, $roomStay->getCancellationPolicy()->getPenaltyAmount());

            $this->assertCount(1, $roomStay->getIncludedServices());

            foreach ($roomStay->getIncludedServices() as $includedService) {
                $this->assertEquals('46545', $includedService->getId());
                $this->assertEquals(null, $includedService->getMealPlanCode());
            }
        }

        // Content
        $this->assertCount(1, $roomStays->getContent()->getRatePlans());

        foreach ($roomStays->getContent()->getRatePlans() as $ratePlan) {
            $this->assertEquals('987657', $ratePlan->getId());
            $this->assertEquals('Основной тариф', $ratePlan->getName());
            $this->assertEquals('1024', $ratePlan->getPropertyId());
        }

        $this->assertCount(1, $roomStays->getContent()->getRoomTypes());

        foreach ($roomStays->getContent()->getRoomTypes() as $roomContentType) {
            $this->assertEquals('45687', $roomContentType->getId());
            $this->assertEquals('Стандартный', $roomContentType->getName());
            $this->assertEquals('1024', $roomContentType->getPropertyId());
        }

        // Warnings
        $this->assertCount(1, $roomStays->getWarnings());

        foreach ($roomStays->getWarnings() as $warning) {
            $this->assertEquals('NotEnoughRights', $warning->getCode());
            $this->assertEquals('Not enough rights to hotel', $warning->getMessage());
        }
    }

    // todo: реализовать базовый метод для проверки работоспособности реквест методов
    public function testRequestSuccess(): void
    {
        $arrivalDate =  new \DateTimeImmutable('2019-10-01 15:45');
        $roomStaysRequest = new RoomStays(1, $arrivalDate, new \DateTimeImmutable('2019-10-15 17:20:11'));

        $referenceRequest = [
            'adults' => 1,
            'arrivalDate' => '2019-10-01',
            'departureDate' => '2019-10-15',
        ];

        $guzzleClientMock =
            $this->createMock(Client::class);

        $guzzleClientMock
            ->method('request')
            ->willReturnCallback(function (string $method, $uri = '', array $options = []) use ($referenceRequest) {
                $this->assertEquals($referenceRequest, $options['json']);

                // todo: заменить реальным моком
                return new Response(200, [], json_encode(['some_json_key' => 'some_json_value']));
            });

        $travelLineClient = new TravelLineClient($guzzleClientMock, '111');
        $travelLineClient->searchRoomStays($roomStaysRequest);
    }
}
