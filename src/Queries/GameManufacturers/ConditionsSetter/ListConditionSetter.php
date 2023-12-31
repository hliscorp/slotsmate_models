<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\ConditionsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\ConditionsSetter\GameManufacturerConditions;
use Lucinda\Query\Clause\Condition;
class ListConditionSetter extends GameManufacturerConditions
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
        $this->setDevice($condition);
        $this->setGameTypeCondition($condition);
        $this->setDateLaunchedCondition($condition);
        $this->setGameIsOpen($condition);
        $this->setIsMain($condition);
        $this->setExcludedIdsCondition($condition);
        $this->setSelectedCountryCondition($condition);
    }

    protected function setSelectedCountryCondition(Condition $condition): void
    {
        if ($this->filter->getSelectedCountry()) {
            $group = new Condition([], \Lucinda\Query\Operator\Logical::_OR_);
            $group->setIsNull("t3.id");
            $group->set("t3.is_allowed",1);
            $condition->setGroup($group);
        }
    }

    protected function setGameTypeCondition(Condition $condition): void
    {
        $condition->setIn("t2.game_type_id ", [12,4]);
    }

    protected function setDateLaunchedCondition(Condition $condition): void
    {
        $date = date("Y-m-d");
        $condition->set("COALESCE(t2.date_launched, '0000-00-00')","'".$date."'" , \Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
    }

    protected function setDevice(Condition $condition): void
    {
            $device = $this->filter->getDevice();
            $condition->set("t2.{$device}", 1);
    }

    protected function setGameIsOpen(Condition $condition): void
    {
        $condition->set("t2.is_open", 1);
    }

    protected function setIsMain(Condition $condition): void {
        if ($this->filter->getIsMain()) {
            $condition->set("t1.main",1);
        }
    }

    protected function setExcludedIdsCondition(Condition $condition): void
    {
        if ($excludedIds = $this->filter->getExcludedIds()) {
            $condition->setIn("t1.id", $excludedIds, false);
        }
    }

}