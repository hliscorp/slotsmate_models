<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\JoinsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\JoinsSetter\BankingMethodListJoins;

class ListJoinsSetter extends BankingMethodListJoins
{
    protected function appendJoins(): void
    {
        parent::appendJoins();

        if($this->filter->getUserCountry()) {
            $this->query->joinInner('banking_methods__countries', 't9')->on(["t9.banking_method_id"=>"t1.id"])->set("t9.country_id", $this->filter->getUserCountry());
        }
    }
}
