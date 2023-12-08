<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers;

use Hlis\SlotsMateModels\Queries\GameManufacturers\ConditionsSetter\ListConditionSetter;
use Hlis\SlotsMateModels\Queries\GameManufacturers\JoinsSetter\ListJoinsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\GameManufacturerListTotal as DefaultGameManufacturerListTotal;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class GameManufacturerListTotal extends DefaultGameManufacturerListTotal
{
    protected function setJoins(): void
    {
        $setter = new ListJoinsSetter($this->filter, $this->query);
        $this->groupBy = $setter->isGroupBy();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new ListConditionSetter($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();

    }
}