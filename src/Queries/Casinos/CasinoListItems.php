<?php
namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\GlobalModels\Filters\Filter;
use Hlis\SlotsMateModels\Queries\Casinos\ConditionsSetter\CasinoListConditions;
use Hlis\GlobalModels\Queries\Casinos\CasinoListItems as GlobalCasinoListItems;
use Hlis\GlobalModels\Queries\Casinos\JoinsSetter\CasinoListItemsJoins;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class CasinoListItems extends GlobalCasinoListItems
{
    protected string $orderByAlias;

    public function __construct(Filter $filter, string $orderByAlias, int $limit, int $offset)
    {
        $this->orderByAlias = $orderByAlias;
        parent::__construct($filter, $orderByAlias, $limit, $offset);
    }

    protected function setFields(Fields $fields): void
    {
        $setter = new CasinoListFields($this->filter);
        $setter->appendFields($fields);
    }

    protected function setJoins(): void
    {
        $setter1 = new CasinoListItemsJoins($this->filter, $this->query);
        $groupBy1 = $setter1->isGroupBy();

        $setter2 = new CasinoListJoins($this->filter, $this->query, $this->orderByAlias);
        $groupBy2 = $setter2->isGroupBy();

        $this->groupBy = $groupBy1 || $groupBy2;
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new CasinoListConditions($this->filter);
        $setter->appendConditions($condition);
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new CasinoListOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }
}

