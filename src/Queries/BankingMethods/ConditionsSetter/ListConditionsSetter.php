<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\ConditionsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\ConditionsSetter\BankingMethodConditions;
use Lucinda\Query\Clause\Condition;

class ListConditionsSetter extends BankingMethodConditions
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
    }
}
