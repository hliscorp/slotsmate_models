<?php

namespace Hlis\SlotsmateModels\Queries\BankingMethods\JoinsSetter;

use Hlis\GlobalModels\Queries\BankingMethods\JoinsSetter\BankingMethodListJoins;

class ListJoinsSetter extends BankingMethodListJoins
{
    protected function appendJoins(): void
    {
        parent::appendJoins();

        if ($this->filter->getHasOpenCasinos()) {
            $this->setCasinosJoin();
            $this->setLicenseJoin();
            $this->setCasinoCountryJoin();
            $this->groupBy = true;
        }
        if ($this->filter->getHasLatestDateUpdated()) {
            $this->setCasinosJoin();
            $this->groupBy = true;
        }
        if($this->filter->getLocaleCodeRelevant()) {
            $this->query->joinLeft("locales", "l")->on(["l.code" => '"'.$this->filter->getLocaleCodeRelevant().'"']);

            if ($this->filter->getMethodRestrictedInCountry()) {
                $this->query->joinInner('banking_methods__countries', 't9')->on(["t9.banking_method_id"=>"t1.id"])->set("t9.country_id",'l.country_id');
            } else {
                $this->query->joinLeft("banking_methods__locale", "t8")->on(["t8.banking_method_id"=>"t1.id"])->set("t8.locale_id",'l.id');
            }

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

    protected function setLicenseJoin(): void
    {
        if ($licenseID = $this->filter->getLicense()) {
            $this->query->joinInner("casinos__licenses", "t6")->on([
                "t5.id" => "t6.casino_id",
                "t6.license_id" => $licenseID
            ]);
        }
    }

    protected function setCasinoCountryJoin(): void
    {
        if ($this->filter->getRestrictByCasinoCountry()) {
            $this->query->joinInner("casinos__countries_allowed", "t7")->on([
                "t5.id" => "t7.casino_id",
                "t7.country_id" => $this->filter->getSelectedCountry()
            ]);
        }
    }
}
