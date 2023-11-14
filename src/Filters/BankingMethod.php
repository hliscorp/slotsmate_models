<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BankingMethod as DefaultBankingMethod;
class BankingMethod extends DefaultBankingMethod
{
    private ?int $license = null;
    private ?bool $hasOpenCasinos = null;
    private ?bool $restrictByCasinoCountry = null;
    private ?array $excludedId = null;
    private ?array $selectedId = null;
    private ?bool $hasLatestDateUpdated = null;
    private ?string $localeCodeRelevant = null;
    private ?bool $methodRestrictedInCountry = null;

    public function getLicense(): ?int
    {
        return $this->license;
    }

    public function setLicense(int $licenseID): void
    {
        $this->license = $licenseID;
    }

    public function getHasOpenCasinos(): ?bool
    {
        return $this->hasOpenCasinos;
    }

    public function setHasOpenCasinos(bool $hasOpenCasinos): void
    {
        $this->hasOpenCasinos = $hasOpenCasinos;
    }

    public function getRestrictByCasinoCountry(): ?bool
    {
        return $this->restrictByCasinoCountry;
    }

    public function setRestrictByCasinoCountry(bool $restrictByCasinoCountry): void
    {
        $this->restrictByCasinoCountry = $restrictByCasinoCountry;
    }

    public function getExcludedId(): ?array
    {
        return $this->excludedId;
    }

    public function addExcludedId(int $excludedId): void
    {
        $this->excludedId[$excludedId] = $excludedId;
    }

    public function getSelectedId(): ?array
    {
        return $this->selectedId;
    }

    public function addSelectedId(int $selectedId): void
    {
        $this->selectedId[$selectedId] = $selectedId;
    }

    public function getHasLatestDateUpdated(): ?bool
    {
        return $this->hasLatestDateUpdated;
    }

    public function setHasLatestDateUpdated(bool $hasLatestDateUpdated): void
    {
        $this->hasLatestDateUpdated = $hasLatestDateUpdated;
    }
    
    public function setLocaleCodeRelevant(string $localeCodeRelevant) : void
    {
        $this->localeCodeRelevant = $localeCodeRelevant;
    }

    public function getLocaleCodeRelevant(): ?string
    {
        return $this->localeCodeRelevant;
    }

    public function getMethodRestrictedInCountry(): ?bool
    {
        return $this->methodRestrictedInCountry;
    }

    public function setMethodRestrictedInCountry(bool $methodRestrictedInCountry): void
    {
        $this->methodRestrictedInCountry = $methodRestrictedInCountry;
    }
}
