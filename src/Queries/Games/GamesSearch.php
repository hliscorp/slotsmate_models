<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\SlotsMateModels\Queries\Games\ConditionsSetter\GameListSearchCondition;
use Hlis\SlotsMateModels\Queries\Games\FieldsSetter\GameListSearchFields;
use Hlis\SlotsMateModels\Queries\Games\JoinsSetter\GameListSearchJoins;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class GamesSearch extends GamesList
{
    protected function setFields(Fields $fields): void
    {
        $object = new GameListSearchFields($this->filter);
        $object->appendFields($fields);
    }

    protected function setGroupBy(): void
    {
        $this->query->groupBy(["t1.id"]);
    }

    protected function setJoins(): void
    {
        new GameListSearchJoins($this->filter, $this->query);
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new GameListSearchCondition($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new GamesListSearchOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }
}