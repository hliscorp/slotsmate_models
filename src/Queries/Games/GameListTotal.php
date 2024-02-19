<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\GlobalModels\Queries\Games\GameListTotal as GlobalGameListTotal;
use Hlis\SlotsMateModels\Queries\Games\ConditionsSetter\GameListConditions;
use Hlis\SlotsMateModels\Queries\Games\JoinsSetter\GameListJoins;
use Lucinda\Query\Clause\Condition;

class GameListTotal extends GlobalGameListTotal
{
    protected function setJoins(): void
    {
        new GameListJoins($this->filter, $this->query);
        $this->groupBy = true;
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new GameListConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }
}