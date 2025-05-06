<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\JoinsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\JoinsSetter\BankingMethodListJoins;

class ListJoinsSetter extends BankingMethodListJoins
{
    protected function appendJoins(): void
    {
        parent::appendJoins();
        $this->setLocaleJoin();
        if ($this->filter->getHasOpenCasinos() || $this->filter->getHasLatestDateUpdated()) {
            $this->setCasinosJoin();
            $this->setCasinoCountryAllowedJoin();
            $this->groupBy = true;
        }
    }

    protected function setLocaleJoin(): void
    {
        if (is_null($this->filter->getLocale())) {
            return;
        }
        $this->query->joinInner("locale__banking", "lb")
            ->on(["t1.id"=>"lb.banking_id", "lb.locale_id"=> $this->filter->getLocale()]);
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

    protected function setCasinoCountryAllowedJoin(): void
    {
        if ($userCountry = $this->filter->getUserCountry()) {
            $this->query->joinLeft("banking_methods__countries", "t2")->on([
                "t1.id" => "t2.banking_method_id",
                "t2.country_id" => $userCountry
            ])->set(
                "t2.country_id", $this->filter->getUserCountry()
            );
        }
    }
}
