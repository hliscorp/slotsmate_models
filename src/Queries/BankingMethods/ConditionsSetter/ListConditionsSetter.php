<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\ConditionsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\ConditionsSetter\BankingMethodConditions;
use Lucinda\Query\Clause\Condition;

class ListConditionsSetter extends BankingMethodConditions
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);

        $this->setCasinosCondition($condition);
    }

    protected function setCasinosCondition(Condition $condition): void
    {
        if ($this->filter->getHasOpenCasinos()) {
            $condition->set("t5.is_open", 1);
        }
    }

    protected function setIsOpenCondition(Condition $condition): void
    {
        $condition->set("t1.is_open", 1); // this condition is always true in site
    }

}
