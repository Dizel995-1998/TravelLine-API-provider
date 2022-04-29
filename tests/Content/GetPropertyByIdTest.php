<?php

namespace egik\TravellineApi\Content;

use egik\TravellineApi\BaseTestCase;
use egik\TravellineApi\TravelLineClient;

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

        // Rate plans
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

        // Room Types
        $this->assertCount(1, $specifiedProperty->getRoomTypes());
        $roomType = current($specifiedProperty->getRoomTypes());

        $this->assertEquals('82751', $roomType->getId());
        $this->assertEquals('Стандартный', $roomType->getName());
        $this->assertEquals('Каждый номер (25 м2) оформлен в стиле, сочетающем элегантную классику с современными элементами декора и высоким уровнем комфорта.  Номера категории Стандарт рассчитаны на размещение 2-х человек на двух раздельных полутораспальных кроватях (120*200). Возможно размещение третьего человека на дополнительном месте, устанавливается евро-раскладушка. Для маленьких детей предоставляются кроватки. 

В каждом из номеров к услугам гостей:
-	Высокоскоростной WiFi интернет, LCD телевизор с большим выбором кабельных каналов и возможностью просмотра кинофильмов через интернет
-	Просторные ванные комнаты, оборудованные душевыми кабинами с гидромассажным и тропическим душем; 
-	Косметика и туалетные принадлежности, халаты и тапочки
-	Высококачественное постельное белье
-	Балкон, оснащенный удобной мебелью, прекрасный вид на Финский залив и острова.', $roomType->getDescription());

        $this->assertCount(1, $roomType->getAmenities());
        $amenity = current($roomType->getAmenities());

        $this->assertEquals(6, $amenity->getAmenityCategoryIndex());
        $this->assertEquals('HydromassageShower', $amenity->getCode());
        $this->assertEquals('гидромассажный душ', $amenity->getName());

        // Services
        $this->assertCount(1, $specifiedProperty->getServices());
        $service = current($specifiedProperty->getServices());

        $this->assertEquals('42807', $service->getId());
        $this->assertEquals('Новогодняя елка', $service->getName());
        $this->assertEquals('Детская Новогодняя ёлка', $service->getDescription());
        $this->assertEquals('Common', $service->getKind());
        $this->assertNull($service->getMealPlanCode());
        $this->assertNull($service->getMealPlanName());
        $this->assertEquals([['url' => 'https://www.travelline.ru/images/sample.jpg']], $service->getImages());
        $this->assertTrue($service->getVat()->isApplicable());
        $this->assertTrue($service->getVat()->isIncluded());
        $this->assertEquals(20, $service->getVat()->getPercent());

        // AmenityCategories
        $this->assertCount(1, $specifiedProperty->getAmenityCategories());
        $amenityCategory = current($specifiedProperty->getAmenityCategories());
        $this->assertEquals(6, $amenityCategory->getIndex());
        $this->assertEquals('Внешняя территория и вид из окон', $amenityCategory->getName());
    }
}
