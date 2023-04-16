<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\FeedingTime;
use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FeedingTimeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Cat $maleCat */
        $maleCat = $this->getReference(CatFixtures::MALE_CAT_REFERENCE);

        /** @var Cat $femaleCat */
        $femaleCat = $this->getReference(CatFixtures::FEMALE_CAT_REFERENCE);

        /** @var Food $dryFood */
        $dryFood = $this->getReference(FoodFixtures::DRY_FOOD_REFERENCE);

        /** @var Food $dietDryFood */
        $dietDryFood = $this->getReference(FoodFixtures::DIET_DRY_FOOT_REFERENCE);

        $feedingTimeMaleCatMonday = new FeedingTime();
        $feedingTimeMaleCatMonday->setFood($dryFood);
        $feedingTimeMaleCatMonday->setWeekDay(1);
        $feedingTimeMaleCatMonday->setTime(date_create('12:00'));
        $feedingTimeMaleCatMonday->setCat($maleCat);
        $manager->persist($feedingTimeMaleCatMonday);

        $feedingTimeMaleCatTuesday = new FeedingTime();
        $feedingTimeMaleCatTuesday->setFood($dryFood);
        $feedingTimeMaleCatTuesday->setWeekDay(2);
        $feedingTimeMaleCatTuesday->setTime(date_create('08:00'));
        $feedingTimeMaleCatTuesday->setCat($maleCat);
        $manager->persist($feedingTimeMaleCatTuesday);

        $feedingTimeFemaleCatSaturday = new FeedingTime();
        $feedingTimeFemaleCatSaturday->setFood($dietDryFood);
        $feedingTimeFemaleCatSaturday->setWeekDay(6);
        $feedingTimeFemaleCatSaturday->setTime(date_create('08:00'));
        $feedingTimeFemaleCatSaturday->setCat($femaleCat);
        $manager->persist($feedingTimeFemaleCatSaturday);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CatFixtures::class,
            FoodFixtures::class
        ];
    }
}
