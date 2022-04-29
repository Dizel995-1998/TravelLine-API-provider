<?php

namespace egik\TravellineApi;

class GetPropertyByIdTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $specifiedProperty = $travelLineClient->getPropertyById('5555');

        $this->assertEquals('1024', $specifiedProperty->getId());
        $this->assertEquals('Тестовая гостиница Travelline', $specifiedProperty->getName());
        $this->assertEquals('string', $specifiedProperty->getDescription());
        $this->assertCount(1, $specifiedProperty->getImages());
        $this->assertEquals([['url' => 'https://www.travelline.ru/images/sample.jpg']], $specifiedProperty->getImages());
        $this->assertEquals(4, $specifiedProperty->getStars());

        // contactInfo -> address
        $address = $specifiedProperty->getContactInfo()->getAddress();

        $this->assertEquals('129366', $address->getPostalCode());
        $this->assertEquals('RUS', $address->getCountryCode());
        $this->assertEquals('г. Москва', $address->getRegion());
        $this->assertEquals('18', $address->getRegionId());
        $this->assertEquals('г. Москва', $address->getCityName());
        $this->assertEquals('8', $address->getCityId());
        $this->assertEquals('пр-т Мира, д. 150', $address->getAddressLine());
        $this->assertEquals(56.637028, $address->getLatitude());
        $this->assertEquals(47.8772, $address->getLongitude());
        $this->assertEquals('Поверните, когда увидите парус', $address->getRemark());

        // contactInfo -> phones
        $phones = $specifiedProperty->getContactInfo()->getPhones();
        $this->assertCount(1, $phones);

        foreach ($phones as $phone) {
            $this->assertEquals('+7 (495) 234-00-00', $phone->getPhoneNumber());
            $this->assertEquals('Голосовой помощник', $phone->getRemark());
        }

        // contactInfo -> emails
        $emails = $specifiedProperty->getContactInfo()->getEmails();
        $this->assertCount(1, $emails);
        $this->assertEquals(['travellinehotel@travelline.ru'], $emails);

        // policy
        $this->assertEquals('14:00', $specifiedProperty->getPolicy()->getCheckInTime());
        $this->assertEquals('12:00', $specifiedProperty->getPolicy()->getCheckOutTime());

        // timezone
        $this->assertEquals(['name' => 'Russian Standard Time'], $specifiedProperty->getTimeZone());

        $this->assertCount(1, $specifiedProperty->getRatePlans());

        foreach ($specifiedProperty->getRatePlans() as $ratePlan) {
            $this->assertEquals('133528', $ratePlan->getId());
            $this->assertEquals('Основной тариф', $ratePlan->getName());
            $this->assertEquals('Забронируйте проживание по самой выгодной цене!
В стоимость проживания включено:
- Бесплатная охраняемая парковка на территории отеля
- Высокоростной беспроводной интернет
- Детская площадка на территории отеля', $ratePlan->getDescription());

            $this->assertEquals('RUB', $ratePlan->getCurrency());
            $this->assertEquals(['42807'], $ratePlan->getIncludedServicesIds());

            // Vat
            $this->assertTrue($ratePlan->getVat()->isApplicable());
            $this->assertTrue($ratePlan->getVat()->isIncluded());
            $this->assertEquals(20, $ratePlan->getVat()->isApplicable());
        }
    }
}
