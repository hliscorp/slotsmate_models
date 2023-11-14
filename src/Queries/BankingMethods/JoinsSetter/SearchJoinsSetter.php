<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\JoinsSetter;

class SearchJoinsSetter extends ListJoinsSetter
{
    protected function appendJoins(): void {
        $this->setCasinoDepositMethodsJoin();
        $this->setCasinosJoin();
        $this->setSelectedCountryJoin();
        $this->setCasinoLicenseJoin();
    }

    protected function setCasinoDepositMethodsJoin(): void {
        $this->query->joinInner('casinos__deposit_methods', 'cdm')->on(['t1.id' => 'cdm.banking_method_id']);
    }

    protected function setCasinosJoin(): void
    {
        $this->query->joinInner('casinos', 't3')->on(['cdm.casino_id' => 't3.id']);
    }

    protected function setCasinoLicenseJoin() : void {
        if ($this->filter->getLicense()) {
            $this->query->joinInner('casinos__licenses', 'c_l')->on(['t3.id' => 'c_l.casino_id', 'c_l.license_id' => $this->filter->getLicense()]);
        }
    }
}