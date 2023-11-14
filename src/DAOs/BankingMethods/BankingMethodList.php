<?php

namespace Hlis\SlotsmateModels\DAOs\BankingMethods;

use Hlis\SlotsmateModels\Builders\BankingMethod\Basic as BankingMethodBuilder;
use Hlis\GlobalModels\DAOs\BankingMethods\BankingMethodList as GlobalBankingMethodList;
use Hlis\SlotsmateModels\Queries\BankingMethods\BankingMethodListItems as BankingMethodListQuery;
use function Hlis\SlotsmateModels\DAOs\BankingMethods\SQL;

class BankingMethodList extends GlobalBankingMethodList
{
    protected function createTrunks(): void
    {
        $builder = new BankingMethodBuilder();
        $querier = new BankingMethodListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = \SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }
}