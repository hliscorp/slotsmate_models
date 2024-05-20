<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\ConditionsSetter;

use Hlis\GlobalModels\Queries\BlogBonuses\ConditionsSetter\BonusListConditions as GlobalBonusListConditions;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Operator\Comparison;

class BonusListConditions extends GlobalBonusListConditions
{
    protected function setDateExpiredCondition(Condition $condition): void
    {
        if ($this->filter->getDateExpires()) {
            $this->buildDateCondition($condition, "t1.expiration_date", $this->filter->getDateExpires());
        } elseif ($this->filter->getIsActive()) {
            $or = new \Lucinda\Query\Clause\Condition([], \Lucinda\Query\Operator\Logical::_OR_);
            $or->set(
                "t1.expiration_date",
                "'" . date("Y-m-d") . "'",
                Comparison::GREATER_EQUALS
            );
            $or->setIsNull("t1.expiration_date");
            $condition->setGroup($or);
        } elseif ($this->filter->getIsExpired()) {
            $condition->set(
                "t1.expiration_date",
                "'" . date("Y-m-d") . "'",
                Comparison::LESSER
            );
        }
    }
}
