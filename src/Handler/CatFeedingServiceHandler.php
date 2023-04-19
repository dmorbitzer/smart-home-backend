<?php

namespace App\Handler;

use App\Message\CatFeedingServiceMessage;
use App\Repository\CatRepository;
use App\Repository\FoodRepository;
use App\Repository\ServiceRepository;
use App\Service\LogServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

use function Symfony\Component\Clock\now;

#[AsMessageHandler]
class CatFeedingServiceHandler
{
    /** @var LogServiceInterface  */
    private LogServiceInterface $logService;

    /** @var ServiceRepository  */
    private ServiceRepository $serviceRepository;

    /** @var CatRepository  */
    private CatRepository $catRepository;

    /** @var FoodRepository  */
    private FoodRepository $foodRepository;

    /**
     * @param LogServiceInterface $logService
     * @param ServiceRepository $serviceRepository
     * @param CatRepository $catRepository
     * @param FoodRepository $foodRepository
     */
    public function __construct(
        LogServiceInterface $logService,
        ServiceRepository $serviceRepository,
        CatRepository $catRepository,
        FoodRepository $foodRepository
    ) {
        $this->logService = $logService;
        $this->serviceRepository = $serviceRepository;
        $this->catRepository = $catRepository;
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param CatFeedingServiceMessage $message
     */
    public function __invoke(CatFeedingServiceMessage $message)
    {
        $cat = $this->catRepository->find($message->getCatId());
        $food = $this->foodRepository->find($message->getFoodId());
        $service = $this->serviceRepository->findOneBy(['identifier' => 'cat_feeding']);

        $data = [
            'cat' => $cat->getName(),
            'foodType' => $food->getName(),
            'type' => $message->getType()
        ];

        $this->logService->log($service, now(), $data);
    }
}
