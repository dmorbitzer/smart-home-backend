<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $catProfileService = new Service();
        $catProfileService->setName('Katzenprofil');
        $catProfileService->setIdentifier('cat_profile');
        $catProfileService->setIsActive(true);
        $manager->persist($catProfileService);

        $catFeedingService = new Service();
        $catFeedingService->setName('Katzenfütterung');
        $catFeedingService->setIdentifier('cat_feeding');
        $catFeedingService->setIsActive(true);
        $manager->persist($catFeedingService);

        $catTrackingService = new Service();
        $catTrackingService->setName('Katzenerkennung');
        $catTrackingService->setIdentifier('cat_tracking');
        $catTrackingService->setIsActive(false);
        $manager->persist($catTrackingService);

        $manager->flush();
    }
}
