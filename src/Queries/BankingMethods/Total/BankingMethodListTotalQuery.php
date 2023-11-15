<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\Total;
use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\Query;
use Hlis\SlotsMateModels\Queries\BankingMethods\Total\BankingMethodListTotalFields;
use Hlis\SlotsMateModels\Queries\BankingMethods\ConditionsSetter\ListConditionsSetter;
use Hlis\SlotsMateModels\Queries\BankingMethods\JoinsSetter\ListJoinsSetter;

class BankingMethodListTotalQuery extends Query
{
    protected $tableName = "banking_methods";
    protected $filter;

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
        $this->query = new \Lucinda\Query\Select($this->tableName, "t1");
        $this->setFields();
        $this->setJoins();
        $this->setWhere();
    }

    protected function setJoins() {
        new ListJoinsSetter($this->filter, $this->query);
    }

    protected function setWhere()
    {
        $conditions = new ListConditionsSetter($this->filter);
        $conditions->appendConditions($this->query->where());
    }

    protected function setFields()
    {
        $fields = new BankingMethodListTotalFields($this->filter);
        $fields->appendFields($this->query->fields());
    }
}