<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses;

use Hlis\SlotsMateModels\Queries\BlogBonuses\ConditionsSetter\BonusListConditions;
use Hlis\GlobalModels\Queries\BlogBonuses\BonusListTotal as GlobalBonusListTotal;
use Lucinda\Query\Clause\Condition;

class BonusListTotal extends GlobalBonusListTotal
{
    protected function setWhere(Condition $condition): void
    {
        $setter = new BonusListConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }
}
