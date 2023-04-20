<?php

namespace App\Service;

use App\Entity\Service;
use DateTimeInterface;

interface LogServiceInterface
{
    public function log(Service $service, DateTimeInterface $time, array $data): void;
}
