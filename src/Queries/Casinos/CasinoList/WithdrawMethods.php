<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class WithdrawMethods extends \Hlis\GlobalModels\Queries\Query
{
    public function __construct (array $casinoIDs)
    {
        $this->query = new Select("casinos__withdraw_methods", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where(), $casinoIDs);
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_id");
        $fields->add("t2.id");
        $fields->add("t2.name");
        $fields->add("IF(t3.id IS NOT NULL,1,0) AS is_locale_allowed");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("banking_methods", "t2")->on(["t1.banking_method_id"=>"t2.id"]);
        $this->query->joinLeft("locale__banking", "t3")->on(["t3.banking_id"=>"t2.id", "lb.locale_id"=>0]);
    }

    protected function setWhere(\Lucinda\Query\Clause\Condition $condition, array $casinoIDs): void
    {
        $condition->setIn("t1.casino_id", $casinoIDs);
    }

}