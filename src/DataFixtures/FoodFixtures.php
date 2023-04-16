<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FoodFixtures extends Fixture
{
    public const DRY_FOOD_REFERENCE = 'dry-food';
    public const DIET_DRY_FOOT_REFERENCE = 'diet-dry-food';

    public function load(ObjectManager $manager): void
    {
        $dryFood = new Food();
        $dryFood->setName('Trockenfutter');
        $manager->persist($dryFood);

        $dietDryFood = new Food();
        $dietDryFood->setName('Diät Trockenfutter');
        $manager->persist($dietDryFood);

        $manager->flush();

        $this->addReference(self::DRY_FOOD_REFERENCE, $dryFood);
        $this->addReference(self::DIET_DRY_FOOT_REFERENCE, $dietDryFood);
    }
}
