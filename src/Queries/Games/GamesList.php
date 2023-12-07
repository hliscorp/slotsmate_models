<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\SlotsMateModels\Queries\Games\ConditionsSetter\GameListConditions;
use Hlis\SlotsMateModels\Queries\Games\FieldsSetter\GameListFields;
use Hlis\SlotsMateModels\Queries\Games\JoinsSetter\GameListJoins;

use Hlis\GlobalModels\Queries\Games\GamesList as GamesListGlobal;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Operator\OrderBy as OrderByOperator;

class GamesList extends GamesListGlobal
{
    protected function setFields(Fields $fields): void
    {
        $setter = new GameListFields($this->filter);
        $setter->appendFields($fields);
    }

    protected function setJoins(): void
    {
        $joins = new GameListJoins($this->filter, $this->query);
        $this->groupBy = $joins->isGroupBy();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new GameListConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new GamesListOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }
}