<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BankingMethod as DefaultBankingMethod;
class BankingMethod extends DefaultBankingMethod
{
    private ?int $excludedId = null;
    private ?bool $hasOpenCasinos = null;
    private ?bool $hasLatestDateUpdated = null;
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getExcludedId(): ?int
    {
        return $this->excludedId;
    }

    public function setExcludedId(?int $excludedId): void
    {
        $this->excludedId = $excludedId;
    }

    public function getHasOpenCasinos(): ?bool
    {
        return $this->hasOpenCasinos;
    }

    public function setHasOpenCasinos(?bool $hasOpenCasinos): void
    {
        $this->hasOpenCasinos = $hasOpenCasinos;
    }

    public function getHasLatestDateUpdated(): ?bool
    {
        return $this->hasLatestDateUpdated;
    }

    public function setHasLatestDateUpdated(?bool $hasLatestDateUpdated): void
    {
        $this->hasLatestDateUpdated = $hasLatestDateUpdated;
    }
}
