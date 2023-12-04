<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\ConditionsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\ConditionsSetter\GameManufacturerConditions;
use Lucinda\Query\Clause\Condition;
class CasinoCounterListConditionSetter extends GameManufacturerConditions
{
    public function appendConditions(Condition $condition): void
    {
        $this->setCasinoIds($condition);
        $this->setLicense($condition);
        $this->setIsOpenCondition($condition);
    }

    protected function setCasinoIds(Condition $condition): void
    {
        if ($this->filter->getCasinoIds()) {
            $condition->setIn("t3.id", $this->filter->getCasinoIds());
        }
    }

    protected function setLicense(Condition $condition): void
    {
        if ($this->filter->getLicenseId()) {
            $condition->set("t5.id", $this->filter->getLicenseId());
        }
    }

    protected function setIsOpenCondition(Condition $condition): void
    {
        if ($this->filter->getIsOpen()) {
            $condition->set("t1.is_open", 1);
        }

        if ($this->filter->getIsCasinoOpen()) {
            $condition->set("t3.is_open", 1);
        }
    }
}