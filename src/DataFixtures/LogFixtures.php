<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\Food;
use App\Entity\Log;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LogFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var Service $catFeedingService */
        $catFeedingService = $this->getReference(ServiceFixtures::CAT_FEEDING_SERVICE_REFERENCE);

        /** @var Cat $maleCat */
        $maleCat = $this->getReference(CatFixtures::MALE_CAT_REFERENCE);

        /** @var Food $dryFood */
        $dryFood = $this->getReference(FoodFixtures::DRY_FOOD_REFERENCE);

        $logOne = new Log();
        $logOne->setService($catFeedingService);
        $logOne->setData([
           'cat' => $maleCat->getName(),
           'foodType' => $dryFood->getName(),
            'type' => 'manuell'
        ]);
        $logOne->setTime(date_create('now'));
        $manager->persist($logOne);

        $logTwo = new Log();
        $logTwo->setService($catFeedingService);
        $logTwo->setData([
            'cat' => $maleCat->getName(),
            'foodType' => $dryFood->getName(),
            'type' => 'automatic'
        ]);
        $logTwo->setTime(date_create('now'));
        $manager->persist($logTwo);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ServiceFixtures::class,
            CatFixtures::class,
            FoodFixtures::class
        ];
    }
}
