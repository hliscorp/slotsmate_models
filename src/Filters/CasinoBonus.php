<?php
namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\CasinoBonus as GlobalCasinoBonus;

class CasinoBonus extends GlobalCasinoBonus
{
    protected ?array $freeSpinsAmount = null;
    protected ?bool $noWagering = null;

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
}
