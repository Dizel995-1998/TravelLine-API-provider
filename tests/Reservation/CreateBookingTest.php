<?php

namespace egik\TravellineApi\Reservation;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\BookingPersonContacts;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\CreateBookingRequest;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\Customer;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingDailyRate;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingGuest;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingPlacement;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingRoomStay;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingTax;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingTaxAmount;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\RoomStayService;
use egik\TravellineApi\TravelLineClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class CreateBookingTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccessResponse(TravelLineClient $travelLineClient): void
    {
        $bookingRequest = new CreateBookingRequest(1, [], new Customer('1', '2', '3', new BookingPersonContacts([], [])), '111');
        $createdBookingResult = $travelLineClient->createBooking($bookingRequest);

        $this->assertEquals('1024', $createdBookingResult->getPropertyId());
        $this->assertCount(1, $createdBookingResult->getRoomStays());

        /**
         * @var BookingRoomStay $roomStay
         */
        $roomStay = current($createdBookingResult->getRoomStays());

        // stayDates
        $this->assertEquals(new \DateTimeImmutable('2019-10-01T14:00'), $roomStay->getStayDates()->getArrivalDateTime());
        $this->assertEquals(new \DateTimeImmutable('2019-10-02T12:00'), $roomStay->getStayDates()->getDepartureDateTime());

        // ratePlan
        $this->assertEquals('133528', $roomStay->getRatePlan()->getId());
        $this->assertEquals('Онлайн бронирование', $roomStay->getRatePlan()->getName());
        $this->assertEquals('Самые лучшие цены, тут', $roomStay->getRatePlan()->getDescription());

        // roomType
        $this->assertEquals('82751', $roomStay->getRoomType()->getId());
        $this->assertEquals('Стандартный', $roomStay->getRoomType()->getName());
        $this->assertCount(1, $roomStay->getRoomType()->getPlacements());

        /**
         * @var BookingPlacement $placement
         */
        $placement = current($roomStay->getRoomType()->getPlacements());

        $this->assertEquals('AdultBed-2', $placement->getCode());
        $this->assertEquals(2, $placement->getCount());
        $this->assertEquals('Adult', $placement->getKind());
        $this->assertNull($placement->getMinAge());
        $this->assertNull($placement->getMaxAge());

        $this->assertCount(1, $roomStay->getGuests());

        /**
         * @var BookingGuest $guest
         */
        $guest = current($roomStay->getGuests());

        $this->assertEquals('Иван', $guest->getFirstName());
        $this->assertEquals('Иванов', $guest->getLastName());
        $this->assertEquals('Иванович', $guest->getMiddleName());
        $this->assertEquals('RUS', $guest->getCitizenship());
        $this->assertEquals('Male', $guest->getSex());

        $this->assertEquals('string', $roomStay->getChecksum());
        $this->assertCount(1, $roomStay->getDailyRates());


        /**
         * @var BookingDailyRate $dailyRate
         */
        $dailyRate = current($roomStay->getDailyRates());

        $this->assertEquals(9500, $dailyRate->getPriceBeforeTax());
        $this->assertEquals(new \DateTimeImmutable('2019-10-01'), $dailyRate->getDate());

        $this->assertEquals(9500, $roomStay->getTotal()->getPriceBeforeTax());
        $this->assertCount(1, $roomStay->getTotal()->getTaxes());

        /**
         * @var BookingTaxAmount $tax
         */
        $tax = current($roomStay->getTotal()->getTaxes());
        $this->assertEquals(100, $tax->getAmount());
        $this->assertEquals(1, $tax->getIndex());

        $this->assertCount(1, $roomStay->getServices());

        /**
         * @var RoomStayService
         */
        $service = current($roomStay->getServices());
        $this->assertEquals('42965', $service->getId());
        $this->assertEquals('Завтрак', $service->getName());
        $this->assertEquals('Завтрак в ресторане по специальной цене', $service->getDescription());
        $this->assertEquals(1200, $service->getPrice());
        $this->assertFalse($service->isInclusive());
        $this->assertEquals('Meal', $service->getKind());
        $this->assertEquals('AllInclusive', $service->getMealPlanCode());
        $this->assertEquals('Все включено', $service->getMealPlanName());

        // todo: realize support service in createdBookingResult

        $customer = $createdBookingResult->getCustomer();
        $this->assertEquals('Иван', $customer->getFirstName());
        $this->assertEquals('Иванов', $customer->getLastName());
        $this->assertEquals('Иванович', $customer->getMiddleName());
        $this->assertEquals('RUS', $customer->getCitizenship());

        $this->assertEquals(['test@travelline.ru'], $customer->getContacts()->getEmails());
        $this->assertEquals(['+79020000000'], $customer->getContacts()->getPhones());

        // total
        $this->assertEquals(1200, $createdBookingResult->getCancellation()->getPenaltyAmount());
        $this->assertEquals('Отмена поездки', $createdBookingResult->getCancellation()->getReason());
        $this->assertEquals(new \DateTimeImmutable('2019-06-20T10:41:04Z'), $createdBookingResult->getCancellation()->getCancelledUtc());

        $cancellationPolicy = $createdBookingResult->getCancellationPolicy();

        $this->assertTrue($cancellationPolicy->isFreeCancellationPossible());
        $this->assertEquals(new \DateTimeImmutable('2019-09-30T12:00'), $cancellationPolicy->getFreeCancellationDeadlineLocal());
        $this->assertEquals(new \DateTimeImmutable('2019-09-30T09:00Z'), $cancellationPolicy->getFreeCancellationDeadlineUtc());
        $this->assertEquals(1200, $cancellationPolicy->getPenaltyAmount());

        $this->assertEquals('20191001-1024-45675262', $createdBookingResult->getNumber());
        $this->assertEquals('Confirmed', $createdBookingResult->getStatus());
        $this->assertEquals(new \DateTimeImmutable('2019-06-20T10:41:04Z'), $createdBookingResult->getCreatedDateTime());
        $this->assertEquals(new \DateTimeImmutable('2019-06-20T11:41:04Z'), $createdBookingResult->getModifiedDateTime());
    }

    public function testSuccessRequest(): void
    {
        $referenceRequest = [
            'booking' => [
                'propertyId' => '1066',
                'customer' => [
                    'firstName' => 'John',
                    'lastName' =>'Dark',
                    'citizenship' => 'RUS',
                    'contacts' => [
                        'phones' => [
                            [
                                'phoneNumber' => '8988 555 44 11',
                            ],
                        ],
                        'emails' => [
                            [
                                'emailAddress' => 'test@mail.ru',
                            ]
                        ],
                    ],
                ],
                'createBookingToken' => '111'
            ],
        ];

        $guzzleClientMock =
            $this->createMock(Client::class);

        $guzzleClientMock
            ->method('request')
            ->willReturnCallback(function (string $method, $uri = '', array $options = []) use ($referenceRequest) {
                $this->assertEquals($referenceRequest, $options['json']);
                return new Response(200, [], json_encode(['booking' => []]));
            });

        $travelLineClient = new TravelLineClient($guzzleClientMock, '111');
        $personContacts = new BookingPersonContacts(['8988 555 44 11'], ['test@mail.ru']);
        $customer = new Customer('John', 'Dark', 'RUS', $personContacts);
        $roomStays = [];

        $bookingRequest = new CreateBookingRequest('1066', $roomStays, $customer, '111');

        $travelLineClient->createBooking($bookingRequest);
    }
}
