<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BlogBonus as GlobalFilter;

class BlogBonus extends GlobalFilter
{
    protected ?bool $isActive = null; // getActive
    protected ?bool $isExpired = null; // getExpired

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
}
