<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BankingMethod as DefaultBankingMethod;
class BankingMethod extends DefaultBankingMethod
{
    private ?bool $hasOpenCasinos = null;

    public function getHasOpenCasinos(): ?bool
    {
        return $this->hasOpenCasinos;
    }

    public function setHasOpenCasinos(?bool $hasOpenCasinos): void
    {
        $this->hasOpenCasinos = $hasOpenCasinos;
    }
}
