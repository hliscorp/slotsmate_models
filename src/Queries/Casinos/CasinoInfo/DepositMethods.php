<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\DepositMethods as DefaultDepositMethods;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class DepositMethods extends DefaultDepositMethods
{
    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.banking_method_id", "id");
        $fields->add("t2.name");
        $fields->add("IF(lb.id IS NOT NULL,1,0) AS is_locale");
    }
    
    protected function setJoins(): void
    {
        parent::setJoins();
        $this->query->joinLeft("locale__banking", "lb")->on(["lb.banking_id"=>"t2.id"]);
        if($this->filter->getLocaleCountry()) {
            $this->query->joinInner('banking_methods__countries_allowed', 't3')->on([
                "t1.banking_method_id" => "t3.banking_method_id",
                "t3.country_id" => $this->filter->getLocaleCountry()
            ]);
        }
    }

    protected function setWhere(Condition $condition): void
    {
        parent::setWhere($condition);
        $condition->set('t2.is_open', 1);
    }
}
