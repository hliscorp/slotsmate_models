<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\ConditionsSetter;

use Hlis\GlobalModels\Queries\Casinos\ConditionsSetter\CasinoListConditions as DefaultCasinoListConditions;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Operator\Comparison;
use Lucinda\Query\Vendor\MySQL\Operator\Logical;

class CasinoListConditions extends DefaultCasinoListConditions
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
        $this->setIsLiveCondition($condition);
        $this->setHasAppCondition($condition);
        $this->setLabelCondition($condition);
        $this->setPromotedCondition($condition);
        $this->setGameTypeCondition($condition);
        $this->setIsNewCondition($condition);
        $this->setIsBestCondition($condition);
        $this->setIsPopularGameTypesCondition($condition);
        $this->setBankingMethodCondition($condition);
        $this->setFreeSpinsAmountCondition($condition);
    }

    protected function setIsLiveCondition(Condition $condition): void
    {
        if ($this->filter->getIsLiveDealer()) {
            $condition->set("t7.is_live", 1);
        }
    }

    protected function setHasAppCondition(Condition $condition): void
    {
        if ($this->filter->getOperatingSystems() && $this->filter->getHasApp()) {
            $condition->set("t10.is_app", 1);
        }
    }

    protected function setLabelCondition(Condition $condition): void
    {
        if ($this->filter->getIsNew()) {
            $condition->set("t1.date_established", "'" . date("Y-m-d", strtotime(date("Y-m-d") . " -1 year")) . "'", Comparison::GREATER);
        } elseif ($this->filter->getIsBest() && $this->filter->isTopRated()) {
            $condition->set("t1.rating_total/t1.rating_votes", 7.5, Comparison::GREATER_EQUALS);
        } elseif ($this->filter->getIsBest()) {
            $condition->set("t1.rating_total/t1.rating_votes", 4, Comparison::GREATER);
        }
    }

    protected function setPromotedCondition(Condition $condition): void
    {
        if (($this->filter->getPromoted()) && $this->filter->getPageType() !== 'no-deposit-slots') {
            $condition->set("t1.status_id", 0);
        }
    }

    protected function setBankingMethodCondition(Condition $condition): void
    {
        if ($this->filter->getBankingMethods()) {
            $group = new Condition([], Logical::_OR_);
            $group->set("t13.id", "", Comparison::IS_NOT_NULL);
            $group->set("t16.id", "", Comparison::IS_NOT_NULL);
            $condition->setGroup($group);
        }
    }

    protected function setGameTypeCondition(Condition $condition): void
    {
        if ($this->filter->getGameTypes() && $this->filter->getPageType() !== 'no-deposit-slots') {
            $condition->set("t7.game_type_id", $this->filter->getGameTypes(), Comparison::IN);
        }
    }

    protected function setIsNewCondition(Condition $condition): void
    {
        if ($this->filter->getIsNew()) {
            $date = date("Y-m-d", strtotime(date("Y-m-d") . " -1 year"));
            $condition->set("t1.date_established", "'" . $date . "'", Comparison::GREATER);
        }
    }

    protected function setIsBestCondition(Condition $condition): void
    {
        if ($this->filter->getIsBest()) {# @no-cache
            $condition->setIn("t1.status_id", [0, 3]);
            // $date = date("Y-m-d", strtotime(date("Y-m-d") . " -6 months"));
            // $condition->set("t1.date_established", "'" . $date . "'", Comparison::LESSER_EQUALS);
            $condition->set("t1.rating_votes", 10, Comparison::GREATER_EQUALS);
            $condition->set("ROUND(t1.rating_total/t1.rating_votes)", 7.5, Comparison::GREATER_EQUALS);
        }
    }


    protected function setIsPopularGameTypesCondition(Condition $condition): void
    {
        if ($this->filter->getIsPopularGameTypes()) {
            if (empty($this->filter->getGameManufacturers())) {
                $condition->set("t26.popular", 1);
            } else {
                $condition->set("t26.filter_sort", 0, Comparison::GREATER);
            }
        }
    }

    protected function setFreeSpinsAmountCondition(Condition $condition): void
    {
        $bonusFilter = $this->filter->getBonus();
        if (!empty($bonusFilter) && !empty($bonusFilter->getFreeSpinsAmount())) {
            $freeSpinsAmount = $bonusFilter->getFreeSpinsAmount();
            $minFreeSpinsAmount = $freeSpinsAmount[0];
            $maxFreeSpinsAmount = $freeSpinsAmount[1];

            if ($minFreeSpinsAmount && $maxFreeSpinsAmount) {
                $condition->setBetween("t22.amount_fs", $minFreeSpinsAmount, $maxFreeSpinsAmount);
            } elseif ($minFreeSpinsAmount) {
                $condition->set("t22.amount_fs", $minFreeSpinsAmount, Comparison::GREATER_EQUALS);
            } elseif ($maxFreeSpinsAmount) {
                $condition->set("t22.amount_fs", $maxFreeSpinsAmount, Comparison::LESSER_EQUALS);
            }
        }
    }
}