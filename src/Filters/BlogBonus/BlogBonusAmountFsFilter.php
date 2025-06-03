<?php

namespace Hlis\SlotsMateModels\Filters\BlogBonus;

class BlogBonusAmountFsFilter
{
    protected ?array $amount = null;
    protected array $bonusTypes = [];

    public function setAmount(int $min = 0, int $max = 0): void
    {
        $this->amount = [$min, $max];
    }

    public function getAmount(): ?array
    {
        return $this->amount;
    }

    public function addBonusType(int $bonusType): void
    {
        $this->bonusTypes[$bonusType] = $bonusType;
    }

    public function getBonusTypes(): array
    {
        return $this->bonusTypes;
    }
}