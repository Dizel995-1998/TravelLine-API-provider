<?php

namespace egik\TravellineApi\Reservation;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\BookingPersonContacts;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\CreateBookingRequest;
use egik\TravellineApi\RequestDto\Reservation\CreateBooking\Customer;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingGuestCount;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingRatePlan;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingRoomType;
use egik\TravellineApi\RequestDto\Reservation\Verify\BookingStayDates;
use egik\TravellineApi\RequestDto\Reservation\Verify\VerifyBookingRequest;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingTax;
use egik\TravellineApi\ResponseDto\Reservation\CreateBooking\BookingTaxAmount;
use egik\TravellineApi\ResponseDto\Search\RoomStays\GuestCount;
use egik\TravellineApi\ResponseDto\Search\RoomStays\Tax;
use egik\TravellineApi\TravelLineClient;
use \egik\TravellineApi\RequestDto\Reservation\Verify\BookingRoomStay;

class VerifyBookingTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccessResponse(TravelLineClient $travelLineClient): void
    {
        $verifyBookingResult = $travelLineClient->verifyBooking($this->createMock(VerifyBookingRequest::class));

        $this->assertNull($verifyBookingResult->getWarnings());
        $this->assertNull($verifyBookingResult->getAlternativeBooking());

        $booking = $verifyBookingResult->getBooking();
        $this->assertEquals('1024', $booking->getPropertyId());

        // booking -> customer
        $customer = $booking->getCustomer();
        $this->assertEquals('Иван', $customer->getFirstName());
        $this->assertEquals('Иванов', $customer->getLastName());
        $this->assertEquals('Иванович', $customer->getMiddleName());
        $this->assertEquals('RUS', $customer->getCitizenship());
        $this->assertEquals(['+79020000000'], $customer->getContacts()->getPhones());
        $this->assertEquals(['test@travelline.ru'], $customer->getContacts()->getEmails());

        // booking -> total
        $total = $booking->getTotal();
        $this->assertEquals(9500, $total->getPriceBeforeTax());
        $this->assertEquals(100, $total->getTaxAmount());
        $this->assertCount(1, $total->getTaxes());

        // booking -> total -> taxes
        $tax = current($total->getTaxes());
        $this->assertInstanceOf(BookingTaxAmount::class, $tax);

        $this->assertEquals(100, $tax->getAmount());
        $this->assertEquals(1, $tax->getIndex());

        // booking -> taxes
        $this->assertCount(1, $booking->getTaxes());

        $tax = current($booking->getTaxes());
        $this->assertInstanceOf(BookingTax::class, $tax);

        $this->assertEquals(1, $tax->getIndex());
        $this->assertEquals('Курортный сбор', $tax->getName());
        $this->assertEquals('Сбор с каждого гостя, оплата на ресепшен', $tax->getDescription());

        $this->assertEquals('RUB', $booking->getCurrencyCode());

        // booking -> cancellation
        $this->assertEquals(1200, $booking->getCancellation()->getPenaltyAmount());
        $this->assertEquals('Отмена поездки', $booking->getCancellation()->getReason());
        $this->assertEquals(new \DateTimeImmutable('2019-06-20T10:41:04Z'), $booking->getCancellation()->getCancelledUtc());

        // booking -> cancellationPolicy
        $this->assertTrue($booking->getCancellationPolicy()->isFreeCancellationPossible());
        $this->assertEquals(new \DateTimeImmutable('2019-09-30T12:00'), $booking->getCancellationPolicy()->getFreeCancellationDeadlineLocal());
        $this->assertEquals(new \DateTimeImmutable('2019-09-30T09:00Z'), $booking->getCancellationPolicy()->getFreeCancellationDeadlineUtc());
        $this->assertEquals(1200, $booking->getCancellationPolicy()->getPenaltyAmount());

        $this->assertEquals('QUNERjMyQjctNTQyNi00NTdELTk0QzItQTU0Mjc0QTY0RThD', $booking->getCreateBookingToken());
    }

//    public function testSuccessRequest(): void
//    {
//        $customer = new Customer('John', 'Franko', 'RUS', new BookingPersonContacts(['8988 444 22 11'], ['test@mail.ru']));
//        $bookingStayDates = new BookingStayDates(new \DateTimeImmutable(), new \DateTimeImmutable());
//        $bookingRoomStay = new BookingRoomStay($bookingStayDates, new BookingRatePlan(), new BookingRoomType(), new BookingGuestCount(), '111111');
//        $bookingVerifyRequest = new VerifyBookingRequest('111', $customer, $bookingRoomStay);
//    }
}