<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\GlobalModels\Entities\BankingMethod as DefaultBankingMethod;

class BankingMethod extends DefaultBankingMethod
{
    public ?int $priority = null;
    public ?int $bankingLocaleSupported = null;
    public ?bool $localBankingMethodEnabled = null;
}
