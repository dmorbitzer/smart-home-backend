<?php

namespace App\Message;

class CatFeedingServiceMessage
{
    /** @var int  */
    private int $catId;

    /** @var int  */
    private int $foodId;

    /** @var string  */
    private string $type;

    /**
     * @param int $catId
     * @param int $foodId
     * @param string $type
     */
    public function __construct(int $catId, int $foodId, string $type)
    {
        $this->catId = $catId;
        $this->foodId = $foodId;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCatId(): int
    {
        return $this->catId;
    }

    /**
     * @param int $catId
     */
    public function setCatId(int $catId): void
    {
        $this->catId = $catId;
    }

    /**
     * @return int
     */
    public function getFoodId(): int
    {
        return $this->foodId;
    }

    /**
     * @param int $foodId
     */
    public function setFoodId(int $foodId): void
    {
        $this->foodId = $foodId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
