<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\ConditionsSetter;

use Hlis\GlobalModels\Queries\BlogBonuses\ConditionsSetter\CasinoListConditions as GlobalCasinoListConditions;
use Lucinda\Query\Clause\Condition;

class CasinoListConditions extends GlobalCasinoListConditions
{
    public function appendConditions(Condition $condition): void
    {
        $this->setStatusCondition($condition);
        $this->setIsOpenCondition($condition);
    }
}
