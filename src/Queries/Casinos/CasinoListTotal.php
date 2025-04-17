<?php

namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\SlotsMateModels\Queries\Casinos\ConditionsSetter\CasinoListConditions;
use Hlis\GlobalModels\Queries\Casinos\CasinoListTotal as DefaultCasinoListTotal;
use Lucinda\Query\Clause\Condition;

class CasinoListTotal extends DefaultCasinoListTotal
{
    protected function setJoins(): void
    {
        $setter = new CasinoListJoins($this->filter, $this->query);
        $this->groupBy = $setter->isGroupBy();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new CasinoListConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }
}