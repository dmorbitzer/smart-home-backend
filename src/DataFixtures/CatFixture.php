<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class CatFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $male = new Gender();
        $male->setName('male');
        $manager->persist($male);

        $female = new Gender();
        $female->setName('female');
        $manager->persist($female);

        $maleCat = new Cat();
        $maleCat->setName('Peter');
        $maleCat->setBirthdate(date_create("2013-03-15"));
        $maleCat->setGender($male);
        $maleCat->setRace('Bengal');
        $maleCat->setWeight(5.2);
        $manager->persist($maleCat);

        $femaleCat = new Cat();
        $femaleCat->setName('Susi');
        $femaleCat->setBirthdate(date_create("2015-07-10"));
        $femaleCat->setGender($female);
        $femaleCat->setRace('Maine-Coon');
        $femaleCat->setWeight(8.5);
        $manager->persist($femaleCat);

        $manager->flush();
    }
}
