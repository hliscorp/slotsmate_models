<?php

namespace Hlis\SlotsMateModels\Queries\Games\ConditionsSetter;

use Hlis\GlobalModels\Queries\Games\ConditionsSetter\GameListConditions as GameListConditionsGlobal;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Operator\Comparison;

class GameListSearchCondition extends GameListConditionsGlobal
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
        $this->setManufacturerOpenCondition($condition);
        $this->setVolatilityCondition($condition);
        $this->setExcludeIdsCondition($condition);
        $this->setSearchCondition($condition);
    }

    protected function setManufacturerOpenCondition(Condition $condition): void
    {
        $this->buildBooleanCondition($condition, "gm.is_open", true);
    }

    protected function setVolatilityCondition(Condition $condition): void
    {
        if ($this->filter->getVolatility()) {
            $condition->setIn("t1.game_volatility_id", $this->filter->getVolatility());
        }
    }

    protected function setExcludeIdsCondition(Condition $condition): void
    {
        if ($excludeIds = $this->filter->getExcludeIds()) {
            $condition->setIn("t1.id", $excludeIds, false);
        }
    }

    protected function setSearchCondition(Condition $condition): void
    {
        if ($this->filter->getSearch()) {
            $search = strtolower(str_replace(" ", "%", $this->filter->getSearch()));
            $condition->setLike('t1.name', "'%".$search."%'");
        }
    }
}