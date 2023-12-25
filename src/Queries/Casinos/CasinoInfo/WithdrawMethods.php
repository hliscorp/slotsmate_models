<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\WithdrawMethods as DefaultWithdrawMethods;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class WithdrawMethods extends DefaultWithdrawMethods
{
    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.banking_method_id", "id");
        $fields->add("t2.name");
    }
    
    protected function setJoins(): void
    {
        parent::setJoins();

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
