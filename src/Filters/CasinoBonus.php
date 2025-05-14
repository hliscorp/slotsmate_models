<?php
namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\CasinoBonus as GlobalCasinoBonus;

class CasinoBonus extends GlobalCasinoBonus
{
    protected ?array $freeSpinsAmount = null;
    protected ?bool $noWagering = null;
    protected ?int $targetCountry = null;
    protected ?int $forceTargetBonuses = null;

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

    public function setIsNoWagering(bool $value): self
    {
        $this->noWagering = $value;
        return $this;
    }

    public function getIsNoWagering(): ?bool
    {
        return $this->noWagering;
    }

    public function setTargetCountry(int $value): self
    {
        $this->targetCountry = $value;
        return $this;
    }

    public function getTargetCountry(): ?int
    {
        return $this->targetCountry;
    }

    public function setTargetBonuses(int $value): self
    {
        $this->forceTargetBonuses = $value;
        return $this;
    }

    public function getTargetBonuses(): ?int
    {
        return $this->forceTargetBonuses;
    }
}
