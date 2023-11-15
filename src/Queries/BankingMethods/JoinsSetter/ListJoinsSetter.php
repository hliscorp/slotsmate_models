<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\JoinsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\JoinsSetter\BankingMethodListJoins;

class ListJoinsSetter extends BankingMethodListJoins
{
    protected function appendJoins(): void
    {
        parent::appendJoins();

        if ($this->filter->getHasOpenCasinos()) {
            $this->setCasinosJoin();
            $this->groupBy = true;
        }

    }

    protected function setCasinosJoin(): void
    {
        $this->query->joinInner("casinos__banking_methods", "t4")->on([
            "t1.id" => "t4.banking_method_id"
        ]);
        $this->query->joinInner("casinos", "t5")->on([
            "t4.casino_id" => "t5.id"
        ]);
    }

    protected function setSelectedCountryJoin(): void
    {
        if ($selectedCountry = $this->filter->getSelectedCountry()) {
            $this->query->joinInner("casinos__countries_allowed", "t2")->on([
                "t5.id" => "t2.casino_id",
                "t2.country_id" => $selectedCountry
            ]);
        }
    }
}
