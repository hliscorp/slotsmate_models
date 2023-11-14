<?php

namespace Hlis\SlotsmateModels\Queries\BankingMethods\ConditionsSetter;

use Lucinda\Query\Clause\Condition;

class SearchConditionSetter extends ListConditionsSetter
{
    public function appendConditions(Condition $condition): void
    {
        $condition->set("t3.is_open", 1);
        $condition->set("t3.is_restricted", 0);
        if ($this->filter->getSearch()) {
            $condition->setLike('t1.name', "'%".$this->filter->getSearch()."%'");
        }

    }
}