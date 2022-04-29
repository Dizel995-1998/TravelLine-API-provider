<?php

namespace egik\TravellineApi;


class GetPropertiesTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $propertiesResult = $travelLineClient->getProperties();
        $this->assertFalse($propertiesResult->isNext());
        $this->assertCount(1, $propertiesResult->getProperties());

        foreach ($propertiesResult->getProperties() as $property) {
            $this->assertEquals('1024', $property->getId());
            $this->assertEquals('Тестовая гостиница Travelline', $property->getName());
            $this->assertEquals('string', $property->getDescription());
            $this->assertCount(1, $property->getImages());
            $this->assertEquals([['url' => 'https://www.travelline.ru/images/sample.jpg']], $property->getImages());
            $this->assertEquals(4, $property->getStars());

            // contact info -> address
            $address = $property->getContactInfo()->getAddress();
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

            // contact info -> phones
            $phones = $property->getContactInfo()->getPhones();
            $this->assertCount(1, $phones);

            foreach ($phones as $phone) {
                $this->assertEquals('+7 (495) 234-00-00', $phone->getPhoneNumber());
                $this->assertEquals('Голосовой помощник', $phone->getRemark());
            }

            // contact info -> emails
            $emails = $property->getContactInfo()->getEmails();
            $this->assertCount(1, $emails);

            foreach ($emails as $email) {
                $this->assertEquals('travellinehotel@travelline.ru', $email);
            }
        }
    }

    // todo: realize
//    public function testIsNull(): void
//    {
//
//    }
}
