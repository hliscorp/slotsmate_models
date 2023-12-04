<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\GameManufacturer as DefaultGameManufacturer;
class GameManufacturer extends DefaultGameManufacturer
{
    private ?bool $isLive = false;
    private ?bool $isMain = false;
    private ?bool $votes = false;
    private ?bool $isNew = false;
    private ?int $volatility = null;
    private ?array $slotTypes = null;
    private ?string $slotLabel = null;
    private ?string $device = null;
    private ?array $casinoIds = null;
    private ?int $license = null;
    private ?array $features = null;
    private ?array $themes = null;
    private ?array $gameTypes = null;
    private ?array $excludedIds = null;

    public function setIsLive(bool $isLive): void
    {
        $this->isLive = $isLive;
    }

    public function getIsLive(): ?bool
    {
        return $this->isLive;
    }

    public function setDevice(string $device): void
    {
        $this->device = $device;
    }

    public function getDevice(): ?string
    {
        return $this->device;
    }

    public function setVotes(bool $isVote): void
    {
        $this->votes = $isVote;
    }

    public function getVotes(): ?bool
    {
        return $this->votes;
    }

    public function setIsMain(bool $isMain): void
    {
        $this->isMain = $isMain;
    }

    public function getIsMain(): ?bool
    {
        return $this->isMain;
    }

    public function addVolatility(bool $volatility): void
    {
        $this->volatility = $volatility;
    }

    public function getVolatility(): ?int
    {
        return $this->volatility;
    }

    public function setIsNew(bool $isNew): void
    {
        $this->isNew = $isNew;
    }

    public function getIsNew(): bool
    {
        return $this->isNew;
    }

    public function addSlotTypes(array $slotTypes): void
    {
        $this->slotTypes[] = $slotTypes;
    }

    public function getSlotTypes(): ?array
    {
        return $this->slotTypes;
    }

    public function setGameVotes(bool $votes): void
    {
        $this->votes = $votes;
    }

    public function getGameVotes(): ?bool
    {
        return $this->votes;
    }

    public function setSlotLabel(string $label): void
    {
        $this->slotLabel = $label;
    }

    public function getSlotLabel(): ?string
    {
        return $this->slotLabel;
    }

    public function addFeatures(int $feature): void
    {
        $this->features[$feature] = $feature;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function addThemes(int $theme): void
    {
        $this->themes[$theme] = $theme;
    }

    public function getThemes(): ?array
    {
        return $this->themes;
    }

    public function getGameTypes(): array
    {
        return $this->gameTypes;
    }

    public function addGameTypes(array $gameTypes): void
    {
        $this->gameTypes = $gameTypes;
    }

    public function addExcludedId(int $id): void
    {
        $this->excludedIds[$id] = $id;
    }

    public function getExcludedIds(): ?array
    {
        return $this->excludedIds;
    }

    public function addCasinoIds(array $casinoIds): void
    {
        $this->casinoIds = $casinoIds;
    }

    public function getCasinoIds(): ?array
    {
        return $this->casinoIds;
    }

    public function setLicenseId(int $licenseId): void
    {
        $this->license = $licenseId;
    }

    public function getLicenseId(): ?int
    {
        return $this->license;
    }

}
