<?php

namespace egik\TravellineApi;

class MealPlanTest extends BaseTestCase
{
    /**
     * @dataProvider mockTravelLineClientDataProvider
     */
    public function testSuccess(TravelLineClient $travelLineClient): void
    {
        $mealPlans = $travelLineClient->getMealPlans();
        $this->assertCount(1, $mealPlans);

        $mealPlan = current($mealPlans);

        $this->assertEquals('AllInclusive', $mealPlan->getCode());
        $this->assertEquals('Все включено', $mealPlan->getName());
    }
}