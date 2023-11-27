<?php

namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\GlobalModels\Queries\Casinos\JoinsSetter\CasinoListJoins as AbstractCasinoListJoins;
use Lucinda\Query\Select;
use \Hlis\SlotsMateModels\DAOs\BankingMethods\BankingMethodList as BankingMethodListDAO;
use \Hlis\SlotsMateModels\Enums\BankingMethodsOrderBy;

class CasinoListJoins extends AbstractCasinoListJoins
{
    protected function getLinkingColumnName(): string
    {
        return "casino_id";
    }

    public function appendJoins(): void
    {
        parent::appendJoins();
        $this->appendLiveDealerJoin();
        $this->appendPopularGameTypesJoin();
        $this->appendCasinoLabelJoin();
        $this->appendBonusesJoin();
        $this->appendAllGameTypesJoin();
        $this->setSoftwareNameJoin();
        $this->appendBankingMethodsJoin();
    }

    protected function setSoftwareNameJoin(): void
    {
        if ($this->filter->getAdditionalSoftware()) {
            $this->query->joinInner("casinos__game_manufacturers", "cgm")->on(["t1.id" => "cgm.casino_id"])->set("cgm.game_manufacturer_id", $this->filter->getAdditionalSoftware());
        }
    }


    protected function appendLiveDealerJoin(): void
    {
        if ($this->filter->getIsLiveDealer() && !$this->filter->getGameTypes()) {
            $this->query->joinInner("casinos__game_types", "t7")->on(["t7.casino_id" => "t1.id"]);
            $this->groupBy = true;
        }
    }

    protected function appendCasinoLabelJoin(): void
    {
        if ($this->filter->getCasinoLabel()) {
            if ($this->filter->getCasinoLabel() == "Stay away") {
                $this->filter->setPromoted(false);
            }

            if ($this->filter->getCasinoLabel() != "New") {
                $sub_select = new \Lucinda\Query\Vendor\MySQL\Select("casino_labels");
                $sub_select->fields(["id"]);
                $sub_select->where()->set("name", "'".$this->filter->getCasinoLabel()."'");
                $this->query->joinInner("casinos__labels", "t5")->on(["t1.id" => "t5.casino_id", "t5.label_id" => "(" . $sub_select->toString() . ")"]);
            }
        }
    }

    protected function appendBonusesJoin(): void
    {
        if ($this->filter->getBonusType() || $this->filter->getFreeBonus()) {
            if ($this->filter->getBonusType() && in_array(
                    strtolower($this->filter->getBonusType()),
                    array("free spins", "no deposit bonus")
                )) {
                // free bonus is no longer relevant
                $sub_select = new \Lucinda\Query\Vendor\MySQL\Select("bonus_types");
                $sub_select->fields(["id"]);
                $sub_select->where()->set("name", "'".$this->filter->getBonusType()."'");
                $this->query->joinInner("casinos__bonuses", "cb")->on(["t1.id" => "cb.casino_id"])
                    ->set("cb.bonus_type_id", "(".$sub_select->toString().")");
            } elseif ($this->filter->getFreeBonus()) {
                $this->query->joinInner("casinos__bonuses", "cb")->on(["t1.id" => "cb.casino_id"])
                    ->set('cb.bonus_type_id', '"^(3|4|5|6|11)$"', 'REGEXP');
            }
        }
    }

    protected function appendBankingMethodsJoin(): void
    {
        if ($bankingMethod = $this->filter->getBankingMethods()) {
            $this->groupBy = true;
            $bankingMethodID = key($bankingMethod->getId());

            $this->query->joinLeft("casinos__deposit_methods", "t13")->on([
                "t1.id"=>"t13.casino_id",
                "t13.banking_method_id"=>$bankingMethodID
            ]);
            $this->query->joinLeft("casinos__withdraw_methods", "t16")->on([
                "t1.id"=>"t16.casino_id",
                "t16.banking_method_id"=>$bankingMethodID
            ]);
        }
    }

    protected function appendAllGameTypesJoin(): void
    {
        if ($this->filter->getGameTypes() || ($this->filter->getIsAllGameTypes() && $this->filter->getPageType() !== 'no-deposit-slots')) {
            $this->query->joinLeft("casinos__bonuses", "cb_fb")->on(["cb_fb.casino_id" => "t1.id"])->setIn("cb_fb.bonus_type_id", [3,4,5]);
            $this->query->joinLeft("casinos__bonuses", "cb_fdb")->on(["cb_fdb.casino_id" => "t1.id", "cb_fdb.bonus_type_id" => "2"]);
            $this->query->joinLeft("casinos__bonuses", "cb_dd")->on(["cb_dd.casino_id" => "t1.id"])->setIn("cb_dd.bonus_type_id", [3,4,5,6,11]);
        }
    }

    protected function appendPopularGameTypesJoin(): void
    {
        if ($this->filter->getIsPopularGameTypes()) {
            if (!$this->filter->getIsLiveDealer() && !$this->filter->getGameTypes()) {
                $this->query->joinInner("casinos__game_types", "t7")->on(["t7.casino_id" => "t1.id"]);
                $this->groupBy = true;
            }
            $this->query->joinInner("game_types", "t26")->on(["t26.id" => "t7.game_type_id"]);
        }
    }
}