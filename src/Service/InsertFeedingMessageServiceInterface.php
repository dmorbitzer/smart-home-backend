<?php

namespace App\Service;

interface InsertFeedingMessageServiceInterface
{
    public const MANUELL_MODE = 'manuell';
    public const AUTOMATIC_MODE = 'automatic';

    public function insert(int $catId, int $foodId, string $type);
}
