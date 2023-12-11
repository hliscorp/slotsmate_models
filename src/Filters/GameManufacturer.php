<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\GameManufacturer as DefaultGameManufacturer;
class GameManufacturer extends DefaultGameManufacturer
{
    private ?bool $isMain = false;
    private ?string $device = null;
    private ?array $excludedIds = null;


    public function setDevice(string $device): void
    {
        $this->device = $device;
    }

    public function getDevice(): ?string
    {
        return $this->device;
    }

    public function setIsMain(bool $isMain): void
    {
        $this->isMain = $isMain;
    }

    public function getIsMain(): ?bool
    {
        return $this->isMain;
    }


    public function addExcludedId(int $id): void
    {
        $this->excludedIds[$id] = $id;
    }

    public function getExcludedIds(): ?array
    {
        return $this->excludedIds;
    }
}
