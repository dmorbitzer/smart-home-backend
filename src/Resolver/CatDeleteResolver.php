<?php

namespace App\Resolver;

use ApiPlatform\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\FeedingTime;
use Doctrine\ORM\EntityManagerInterface;

class CatDeleteResolver implements MutationResolverInterface
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param object|null $item
     * @param array $context
     * @return object|null
     */
    public function __invoke(?object $item, array $context): ?object
    {
        $feedingTimeRepository = $this->entityManager->getRepository(FeedingTime::class);
        $catFeedingTimes = $feedingTimeRepository->findBy(['cat' => $item->getId()]);
        foreach ($catFeedingTimes as $catFeedingTime) {
            $this->entityManager->remove($catFeedingTime);
        }
        $this->entityManager->remove($item);
        $this->entityManager->flush();
        return null;
    }
}
