<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\ConditionsSetter;

use Hlis\GlobalModels\Queries\BlogBonuses\ConditionsSetter\BonusListConditions as GlobalBonusListConditions;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Operator\Comparison;

class BonusListConditions extends GlobalBonusListConditions
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
        $this->setByFreeSpinsAmountCondition($condition);
        $this->setByNoDepositCondition($condition);
        $this->setByNoWageringCondition($condition);
        $this->setGamesRtpCondition($condition);
    }

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

    protected function setCasinosCondition(Condition $condition): void
    {
        if ($casinos = $this->filter->getCasinos()) {
            $object = new CasinoListConditions($casinos);
            $object->appendConditions($condition);
        }
    }

    protected function setByFreeSpinsAmountCondition(Condition $condition): void
    {
        if (!empty($this->filter->getFreeSpinsAmount())) {
            $freeSpinsAmount = $this->filter->getFreeSpinsAmount();
            $minFreeSpinsAmount = $freeSpinsAmount[0];
            $maxFreeSpinsAmount = $freeSpinsAmount[1];

            if ($minFreeSpinsAmount && $maxFreeSpinsAmount) {
                $condition->setBetween("t1.amount_fs", $minFreeSpinsAmount, $maxFreeSpinsAmount);
            } elseif ($minFreeSpinsAmount) {
                $condition->set("t1.amount_fs", $minFreeSpinsAmount, Comparison::GREATER_EQUALS);
            } elseif ($maxFreeSpinsAmount) {
                $condition->set("t1.amount_fs", $maxFreeSpinsAmount, Comparison::LESSER_EQUALS);
            }
        }
    }

    protected function setByNoDepositCondition(Condition $condition): void
    {
        if ($this->filter->getNoDeposit()) {
            $condition->set("t1.minimum_deposit", 0);
        }
    }

    protected function setByNoWageringCondition(Condition $condition): void
    {
        if ($this->filter->getIsNoWagering()) {
            $condition->set("t1.wagering_amount", 0);
        }
    }

    protected function setGamesRtpCondition(Condition $condition): void
    {
        $filterGames = $this->filter->getGames();
        if (!empty($filterGames)) {
            if (!empty($filterGames->getMinRtp())) {
                $condition->set("gt1.rtp", $filterGames->getMinRtp(), Comparison::GREATER_EQUALS);
            }
            if (!empty($filterGames->getMaxRtp())) {
                $condition->set("gt1.rtp", $filterGames->getMaxRtp(), Comparison::LESSER_EQUALS);
            }
        }
    }
}
