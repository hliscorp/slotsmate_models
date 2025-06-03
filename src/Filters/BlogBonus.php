<?php
namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BlogBonus as GlobalFilter;
use Hlis\SlotsMateModels\Filters\BlogBonus\BlogBonusAmountFsFilter;

class BlogBonus extends GlobalFilter
{
    protected ?bool $isActive = null; // getActive
    protected ?bool $isExpired = null; // getExpired
    protected ?BlogBonusAmountFsFilter $freeSpinsAmount = null;
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
    public function getFreeSpinsAmount(): ?BlogBonusAmountFsFilter
    {
        return $this->freeSpinsAmount;
    }

    public function setFreeSpinsAmount(BlogBonusAmountFsFilter $amountFsFilter): void
    {
        $this->freeSpinsAmount = $amountFsFilter;
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
