<?php

namespace Hlis\SlotsmateModels\Queries\BankingMethods;

use Hlis\SlotsmateModels\Enums\BankingMethodsOrderBy;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class BankingMethodListOrderBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case BankingMethodsOrderBy::CASINOS_COUNT:
                $this->orderBy->add("counter", OrderBy::DESC);
                $this->orderBy->add("t1.id", OrderBy::DESC);
                break;
            case BankingMethodsOrderBy::PRIORITY:
                $this->orderBy->add("t1.priority", OrderBy::DESC);
                $this->orderBy->add("t1.id", OrderBy::DESC);
                break;
            case BankingMethodsOrderBy::DATE:
                $this->orderBy->add("date_updated", OrderBy::DESC);
                $this->orderBy->add("t1.id", OrderBy::DESC);
                break;
            case BankingMethodsOrderBy::BANKING_COUNT:
                $this->orderBy->add("counter", OrderBy::DESC);
                break;
        }
    }
}