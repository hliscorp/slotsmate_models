<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BankingMethod as DefaultBankingMethod;
class BankingMethod extends DefaultBankingMethod
{
    private ?bool $totalCount = null;

    public function getTotalCount(): ?bool
    {
        return $this->totalCount;
    }

    public function setTotalCount(bool $totalCount): void
    {
        $this->totalCount = $totalCount;
    }
}
