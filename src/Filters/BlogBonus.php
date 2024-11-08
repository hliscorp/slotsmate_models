<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BlogBonus as GlobalFilter;

class BlogBonus extends GlobalFilter
{
    protected ?bool $isActive = null; // getActive
    protected ?bool $isExpired = null; // getExpired
    protected ?array $freeSpinsAmount = null;
    protected ?bool $noDeposit = null;
    protected ?bool $noWagering = null;

    public function setIsActive(bool $value): self
    {
        $this->isActive = $value;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsExpired(bool $value): self
    {
        $this->isExpired = $value;
        return $this;
    }

    public function getIsExpired(): ?bool
    {
        return $this->isExpired;
    }

    /**
     * @return array|null
     */
    public function getFreeSpinsAmount(): ?array
    {
        return $this->freeSpinsAmount;
    }

    /**
     * @param int $minFreeSpinsAmount
     * @param int $maxFreeSpinsAmount
     */

    public function setFreeSpinsAmount(int $minFreeSpinsAmount = 0, int $maxFreeSpinsAmount = 0): void
    {
        $this->freeSpinsAmount = [$minFreeSpinsAmount, $maxFreeSpinsAmount];
    }

    public function setNoDeposit(bool $value): self
    {
        $this->noDeposit = $value;
        return $this;
    }

    public function getNoDeposit(): ?bool
    {
        return $this->noDeposit;
    }

    public function setIsNoWagering(bool $value): self
    {
        $this->noWagering = $value;
        return $this;
    }

    public function getIsNoWagering(): ?bool
    {
        return $this->noWagering;
    }
}
