<?php

namespace App\Handler;

use App\Message\CatFeedingServiceMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CatFeedingServiceHandler
{
    public function __invoke(CatFeedingServiceMessage $message)
    {
        print_r(
            'Handler handled the feeding message with catId ' .
            $message->getCatId() .
            ' and foodId ' .
            $message->getFoodId() .
            ' and type: ' .
            $message->getType()
        );
    }
}
