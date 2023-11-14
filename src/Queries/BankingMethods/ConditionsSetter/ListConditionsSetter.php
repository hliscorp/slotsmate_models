<?php

namespace Hlis\SlotsmateModels\Queries\BankingMethods\ConditionsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\ConditionsSetter\BankingMethodConditions;
use Lucinda\Query\Clause\Condition;

class ListConditionsSetter extends BankingMethodConditions
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);

        $this->setCasinosCondition($condition);
        $this->setExcludedIdsCondition($condition);
        $this->setSelectedIdsCondition($condition);
        $this->setLocaleCodeRelevant($condition);
    }

    protected function setCasinosCondition(Condition $condition): void
    {
        if ($this->filter->getHasOpenCasinos() || $this->filter->getHasLatestDateUpdated()) {
            $condition->set("t5.is_open", 1);
            $condition->set("t5.is_restricted", 0);
        }
    }

    protected function setIsOpenCondition(Condition $condition): void
    {
        $condition->set("t1.is_open", 1); // this condition is always true in site
    }

    protected function setSelectedIdsCondition(Condition $condition): void
    {
        if ($selectedIds = $this->filter->getSelectedId()) {
            $condition->setIn("t1.id", $selectedIds, true);
        }
    }

    protected function setExcludedIdsCondition(Condition $condition): void
    {
        if ($excludedIds = $this->filter->getExcludedId()) {
            $condition->setIn("t1.id", $excludedIds, false);
        }
    }

    protected function setLocaleCodeRelevant(Condition $condition): void
    {
        if($this->filter->getLocaleCodeRelevant() && !$this->filter->getMethodRestrictedInCountry()) {
            $condition->set("t8.locale_id", 'NULL', 'IS NOT NULL');
        }
    }
}
