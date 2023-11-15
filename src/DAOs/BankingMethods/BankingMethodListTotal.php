<?php

namespace Hlis\SlotsMateModels\DAOs\BankingMethods;
use Hlis\SlotsMateModels\Builders\BankingMethod\Basic as BankingMethodBuilder;
use Hlis\GlobalModels\DAOs\BankingMethods\BankingMethodList as GlobalBankingMethodList;
use Hlis\SlotsMateModels\Queries\BankingMethods\Total\BankingMethodListTotalQuery as BankingMethodListQuery;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\DAOs\AbstractEntityTotal;

class BankingMethodListTotal extends AbstractEntityTotal
{
    protected function getQuery(): Query
    {
        return new BankingMethodListQuery($this->filter);
    }
}