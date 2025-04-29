<?php
namespace Hlis\SlotsMateModels\Queries\Casinos\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Operator\Comparison;
use Lucinda\Query\Operator\Logical;

class CasinoListInstantWithdrawalConditions extends AbstractConditions
{
    public function appendConditions(Condition $condition): void
    {
        $this->setIsInstantWithdrawalCondition($condition);
    }

    protected function setIsInstantWithdrawalCondition(Condition $condition): void
    {
        if ($this->filter->getIsInstantWithdrawal()) {
            $conditionGroupHours = new Condition();
            $conditionGroupHours->set("cwt.end", 24, Comparison::LESSER_EQUALS);
            $conditionGroupHours->set("cwt.unit", "'hour'");

            $conditionGroupDays = new Condition();
            $conditionGroupDays->set("cwt.end", 1, Comparison::LESSER_EQUALS);
            $conditionGroupDays->set("cwt.unit", "'day'");

            $conditionTimeFrame = new Condition([], Logical::_OR_);
            $conditionTimeFrame->setGroup($conditionGroupHours);
            $conditionTimeFrame->setGroup($conditionGroupDays);
            $condition->setGroup($conditionTimeFrame);
        }
    }
}