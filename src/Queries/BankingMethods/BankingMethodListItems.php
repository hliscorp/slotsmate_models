<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods;

use Hlis\SlotsMateModels\Queries\BankingMethods\ConditionsSetter\ListConditionsSetter;
use Hlis\SlotsMateModels\Queries\BankingMethods\JoinsSetter\ListJoinsSetter;
use \Hlis\GlobalModels\Queries\BankingMethods\BankingMethodListItems as DefaultBankingMethodListItems;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class BankingMethodListItems extends DefaultBankingMethodListItems
{
    protected function setFields(Fields $fields): void
    {
        $object = new BankingMethodListFields($this->filter);
        $object->appendFields($fields);
    }

    protected function setJoins(): void
    {
        $setter = new ListJoinsSetter($this->filter, $this->query);
        $this->groupBy = $setter->isGroupBy();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new ListConditionsSetter($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();

    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new BankingMethodListOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }
}