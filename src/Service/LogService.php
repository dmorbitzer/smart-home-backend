<?php

namespace App\Service;

use App\Entity\Log;
use App\Entity\Service;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;

class LogService implements LogServiceInterface
{
    /** @var EntityManagerInterface  */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Service $service
     * @param DateTimeInterface $time
     * @param array $data
     */
    public function log(Service $service, DateTimeInterface $time, array $data): void
    {
        $logEntry = new Log();
        $logEntry->setService($service);
        $logEntry->setData($data);
        $logEntry->setTime($time);

        $this->entityManager->persist($logEntry);
        $this->entityManager->flush();
    }
}
