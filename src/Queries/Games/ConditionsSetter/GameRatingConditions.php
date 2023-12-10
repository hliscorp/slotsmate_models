<?php

namespace Hlis\SlotsMateModels\Queries\Games\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Vendor\MySQL\Operator\Logical;
use Lucinda\Query\Vendor\MySQL\Select;

class GameRatingConditions extends AbstractConditions
{
    public function appendConditions(Condition $condition): void {
        $this->setIDCondition($condition);
        $this->setIsOpen($condition);
        $this->setGameType($condition);
        $this->setDevice($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($ids = $this->filter->getId()) {
            $condition->setIn("t1.game_manufacturer_id", $ids);
        }
    }

    protected function setIsOpen(Condition $condition): void
    {
        $condition->set("t1.is_open", 1);
    }

    protected function setGameType(Condition $condition): void
    {
        $condition->set("t1.game_type", [4,12]);
    }

    protected function setDevice(Condition $condition): void
    {
        $condition->set("t1.game_type", [4,12]);
        $group = new Condition([], Logical::_OR_);
        $group->set("t1.is_mobile", 1);
        $group->set("t1.is_desktop", 1);
        $condition->setGroup($group);
    }
}